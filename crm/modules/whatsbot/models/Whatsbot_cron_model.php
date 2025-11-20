<?php
defined('BASEPATH') or exit('No direct script access allowed');

define('WHATSBOT_CRON', true);

class Whatsbot_cron_model extends App_Model
{
    use modules\whatsbot\traits\Whatsapp;
    public $manually = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('whatsbot_model');
    }

    public function run($manually = false)
    {
        hooks()->do_action('before_whatsbot_cron_run', $manually);

        update_option('last_whatsapp_cron_run', time());

        $hoursThreshold = intval(get_option('session_expiry_hours'));
        if ($hoursThreshold <= 0 || $hoursThreshold > 23) {
            $hoursThreshold = 23; // Default to 23 hours if invalid
        }

        $expiryTimestamp = date('Y-m-d H:i:s', strtotime("-{$hoursThreshold} hours"));

        // Find interactions that need a session reset message
        $wb_default_phone_number = get_option('wac_default_phone_number');
        $this->db->select('id, name, receiver_id, type, type_id, wa_no, wa_no_id, last_msg_time, session_reset_sent');
        $this->db->from(db_prefix() . 'wtc_interactions');
        $this->db->where('session_reset_sent', 0);
        $this->db->where('receiver_id !=', $wb_default_phone_number);
        $this->db->where('last_msg_time <=', $expiryTimestamp);
        $this->db->where('last_msg_time >=', date('Y-m-d H:i:s', strtotime('-24 hours')));
        $expiringSessions = $this->db->get()->result_array();

        $results = [
            'status' => true,
            'total_expiring' => count($expiringSessions),
            'processed' => 0,
            'success' => 0,
            'failed' => 0,
            'details' => []
        ];

        if (empty($expiringSessions)) {
            return $results;
        }
        foreach ($expiringSessions as $session) {

            $results['processed']++;

            $contactData = $this->whatsbot_model->getContactData($session['receiver_id'], $session['name']);
            if (!$contactData) {
                $results['failed']++;
                $results['details'][] = [
                    'id' => $session['id'],
                    'receiver' => $session['receiver_id'],
                    'status' => 'failed',
                    'reason' => 'Contact data not found'
                ];
                continue;
            }

            // Send the session reset message
            $resetResult = $this->sendSessionResetMessage($session);
            if ($resetResult['status']) {
                $results['success']++;
                $results['details'][] = [
                    'id' => $session['id'],
                    'receiver' => $session['receiver_id'],
                    'status' => 'success',
                    'message_id' => $resetResult['message_id'] ?? null
                ];

                // Update the session_reset_sent flag
                $this->db->update(db_prefix() . 'wtc_interactions', ['session_reset_sent' => 1], ['id' => $session['id']]);
            } else {
                $results['failed']++;
                $results['details'][] = [
                    'id' => $session['id'],
                    'receiver' => $session['receiver_id'],
                    'status' => 'failed',
                    'reason' => $resetResult['message'] ?? 'Unknown error'
                ];
            }
        }

        if ($manually == true) {
            $this->manually = true;
            log_activity('Whatsapp Api Cron Invoked Manually');
        }

        hooks()->do_action('after_whatsapp_cron_run', $manually);
    }

    private function sendSessionResetMessage($session)
    {
        $message = get_option('session_expiry_message');

        // Prepare message data
        $messageData = [
            'id' => 0, // Not an actual bot
            'sending_count' => 0,
            'rel_type' => $session['type'],
            'rel_id' => $session['type_id'],
            'reply_text' => $message,
            'bot_header' => '',
            'bot_footer' => '',
            'button1' => '',
            'button1_id' =>  '',
            'button2' => '',
            'button3' => '',
            'filename' => '',
            'option' => ''
        ];
        // Send the message
        try {
            $response = $this->sendMessage($session['receiver_id'], $messageData, $session['wa_no_id']);

            if ($response['status']) {
                // // Store message in the chat history
                $interactionId = $session['id'];
                $this->storeSessionResetMessage($messageData, $interactionId, $response);
                return [
                    'status' => true,
                    'message_id' => $response['data']->messages[0]->id ?? null
                ];
            } else {
                return [
                    'status' => false,
                    'message' => $response['message'] ?? 'Failed to send message'
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function storeSessionResetMessage($data, $interactionId, $response)
    {
        $messageData = [
            'interaction_id' => $interactionId,
            'sender_id' => get_option('wac_default_phone_number'),
            'url' => null,
            'message' => nl2br(wbDecodeWhatsAppSigns($data['reply_text'])),
            'status' => 'sent',
            'time_sent' => date('Y-m-d H:i:s'),
            'message_id' => $response['data']->messages[0]->id ?? null,
            'staff_id' => 0,
            'type' => 'text',
            'is_system' => 1
        ];

        $messageId = $this->interaction_model->insert_interaction_message($messageData);

        return !empty($messageId);
    }
}

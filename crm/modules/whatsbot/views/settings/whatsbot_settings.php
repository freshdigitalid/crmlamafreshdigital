<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<?php $this->load->config('whatsbot/openai'); ?>
<div id="wrapper">
    <div class="content">
        <?php if ($this->session->flashdata('debug')) { ?>
            <div class="alert alert-warning">
                <?= $this->session->flashdata('debug'); ?>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <h4 class="tw-font-bold tw-mt-0 tw-text-neutral-800">
                            <?= _l('settings'); ?>
                        </h4>
                        <div class="panel_s">
                            <div class="panel-body">
                                <div class="tw-flex tw-flex-col tw-gap-6">
                                    <div>
                                        <ul class="custom-tabs tw-space-y-2" role="tablist">

                                            <li role="presentation" class="active">
                                                <a href="#whatsapp_auto_lead" aria-controls="whatsapp_auto_lead" role="tab" data-toggle="tab" class="tw-group padding-5  tw-flex tw-items-center tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-solid fa-comment-dots fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('whatsapp_auto_lead'); ?>
                                                </a>
                                            </li>

                                            <li role="presentation">
                                                <a href="#webhooks" aria-controls="webhooks" role="tab" data-toggle="tab" class="tw-group tw-flex tw-items-center padding-5 tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-solid fa-rotate fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('webhooks'); ?>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#webhooks_receive" aria-controls="webhooks_receive" role="tab" data-toggle="tab" class="tw-group tw-flex tw-items-center padding-5 tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-solid fa-download fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('webhooks') . " (" . _l("receive") . ")"; ?>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#supportagent" aria-controls="supportagent" role="tab" data-toggle="tab" class="tw-group tw-flex padding-5 tw-items-center tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-solid fa-user fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('supportagent'); ?>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#notification_sound" aria-controls="notification_sound" role="tab" data-toggle="tab"
                                                    class="tw-group tw-flex padding-5  tw-items-center tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-solid fa-bell fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('notification_sound'); ?>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#ai_integration" aria-controls="ai_integration" role="tab" data-toggle="tab" class="tw-group tw-flex  padding-5  tw-items-center tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-solid fa-microchip fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('ai_integration'); ?>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#ai_assistent" aria-controls="ai_assistent" role="tab" data-toggle="tab" class="tw-group tw-flex  padding-5  tw-items-center tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-solid fa-gear fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('ai_assistant'); ?>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#clear_chat_history" aria-controls="clear_chat_history" role="tab" data-toggle="tab" class="tw-group tw-flex  padding-5  tw-items-center tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-solid fa-trash-can fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('auto_clear_chat_history'); ?>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#session_management" aria-controls="session_management" role="tab" data-toggle="tab" class="tw-group tw-flex  padding-5  tw-items-center tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-brands fa-whatsapp fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('session_management'); ?>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#opt_out_settings" aria-controls="opt_out_settings" role="tab" data-toggle="tab" class="tw-group tw-flex  padding-5  tw-items-center tw-text-sm hover:tw-text-neutral-800 focus:tw-text-neutral-800 tw-font-medium tw-gap-2.5 tw-text-neutral-600">
                                                    <i class="fa-solid fa-gear text-muted fa-fw fa-lg tw-mr-0.5"></i>
                                                    <?php echo _l('opt_out_settings'); ?>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8 col-lg-9">

                        <h4 class="tw-font-bold tw-mt-0 tw-text-neutral-800">
                            <div class="" id="tabname"><?= _l('whatsapp_auto_lead') ?></div>
                        </h4>
                        <?php

                        $group = 'whatsbot';

                        $actionUrl = $group['update_url']
                            ?? $this->uri->uri_string() . '?group=' . $group . ($this->input->get('tab') ? '&active_tab=' . $this->input->get('tab') : '');

                        $formAttributes = [
                            'id'    => 'settings-form',
                            'class' => isset($group['update_url']) ? 'custom-update-url' : '',
                        ];

                        echo form_open_multipart($actionUrl, $formAttributes);

                        ?>
                        <div class="panel_s">
                            <div class="panel-body">
                                <div class="tab-content mtop15">
                                    <!-- Whatsapp auto lead settings -->
                                    <div role="tabpanel" class="tab-pane active" id="whatsapp_auto_lead">
                                        <div class="mbot15">
                                            <label for="whatsapp_auto_lead_settings"><?php echo _l('convert_whatsapp_message_to_lead'); ?></label>
                                            <div class="onoffswitch">
                                                <input type="checkbox" value="1" class="onoffswitch-checkbox" id="whatsapp_auto_lead_settings" name="settings[whatsapp_auto_lead_settings]" <?php echo ('1' == get_option('whatsapp_auto_lead_settings')) ? 'checked' : ''; ?>>
                                                <label class="onoffswitch-label" for="whatsapp_auto_lead_settings"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php echo render_select('settings[whatsapp_auto_leads_status]', $leads_statuses, ['id', 'name'], 'leads_status', get_option('whatsapp_auto_leads_status'), [], [], '', '', false); ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo render_select('settings[whatsapp_auto_leads_source]', $leads_sources, ['id', 'name'], 'leads_source', get_option('whatsapp_auto_leads_source'), [], [], '', '', false); ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo render_select('settings[whatsapp_auto_leads_assigned]', wb_get_all_staff(), ['staffid', ['firstname', 'lastname']], 'leads_assigned', get_option('whatsapp_auto_leads_assigned'), [], [], '', '', false); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Webhooks resend settings -->
                                    <div role="tabpanel" class="tab-pane" id="webhooks">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="enable_webhooks"><?php echo _l('enable_webhooks'); ?></label>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" value="1" class="onoffswitch-checkbox" id="enable_webhooks" name="settings[enable_webhooks]" <?php echo ('1' == get_option('enable_webhooks')) ? 'checked' : ''; ?>>
                                                    <label class="onoffswitch-label" for="enable_webhooks"></label>
                                                </div>
                                            </div>
                                            <?php $methods = [
                                                ['key' => 'GET', 'value' => 'GET'],
                                                ['key' => 'POST', 'value' => 'POST']
                                            ]; ?>
                                            <?= render_select('settings[webhook_resend_method]', $methods, ['key', 'value'], 'webhook_resend_method', get_option('webhook_resend_method'), [], [], 'col-md-4', '', false); ?>
                                            <div class="form-group col-md-12">
                                                <label for="settings[webhooks_url]" class="control-label"><?php echo _l('webhooks_label'); ?></label>
                                                <input type="text" id="settings[webhooks_url]" name="settings[webhooks_url]" class="form-control" value="<?php echo get_option('webhooks_url'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Webhooks receive settings -->
                                    <div role="tabpanel" class="tab-pane" id="webhooks_receive">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning">
                                                    <?= _l('web_hook_receive_note'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row webhook_row base_webhook_row" id="webhook_row_0">
                                            <div class="form-group col-md-5">
                                                <?php echo render_input('settings[webhook_receive][0][name]', 'webhook_receive_name'); ?>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <?php echo render_input('settings[webhook_receive][0][secret]', 'webhook_receive_secret'); ?>
                                            </div>
                                            <div class="form-group col-md-2 action">
                                                <button type="button" class="btn btn-sm btn-success add_row mtop30"><i class="fa fa-plus mright5"></i><?= _l('add') ?></button>
                                            </div>
                                        </div>
                                        <?php foreach ($webhook_sources as $key => $source) {
                                        ?>
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <?php echo render_input('settings[webhook_receive][' . ($key + 1) . '][id]', '', $source['id'], "hidden"); ?>
                                                    <div class="row webhook_row base_webhook_row" id="webhook_row_<?= ($key + 1) ?>">
                                                        <div class="form-group col-md-5">
                                                            <?php echo render_input('settings[webhook_receive][' . ($key + 1) . '][name]', 'webhook_receive_name', $source['name']); ?>
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <?php echo render_input('settings[webhook_receive][' . ($key + 1) . '][secret]', 'webhook_receive_secret', $source['secret']); ?>
                                                        </div>
                                                        <div class="form-group col-md-2 action btn-group">
                                                            <button type="button" class="btn btn-sm btn-primary copy_url mtop30" data-clipboard-text="<?php echo site_url('whatsbot/get_webhook/' . $source['id'] . '/' . $source['hash']) ?>" data-toggle="tooltip" data-container="body" data-title="<?= _l('copy_url') ?>"><i class="fa fa-clipboard"></i></button>
                                                            <button type="button" data-source_id="<?= $source['id']  ?>" class="btn btn-sm btn-warning mtop30 webhook_json_modal" data-toggle="tooltip" data-container="body" data-title="<?= _l('json_for_mapping') ?>"><i class="fa fa-file-code"></i></button>
                                                            <a href="<?= admin_url(WHATSBOT_MODULE . '/whatsbot_settings/delete_webhook_source/' . $source['id']); ?>" class="btn btn-sm btn-danger _delete mtop30" data-toggle="tooltip" data-container="body" data-title="<?= _l('delete') ?>"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-10">
                                                        <label class="form-label"><?= _l('delivery_url') ?></label>
                                                        <div class="label label-info"><span><?php echo site_url('whatsbot/get_webhook/' . $source['id'] . '/' . $source['hash']) ?></span></div>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <!-- Support agents settings -->
                                    <div role="tabpanel" class="tab-pane" id="supportagent">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="enable_supportagnet"><?php echo _l('assign_chat_permission_to_support_agent'); ?></label>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" value="1" class="onoffswitch-checkbox" id="enable_supportagent" name="settings[enable_supportagent]" <?php echo ('1' == get_option('enable_supportagent')) ? 'checked' : ''; ?>>
                                                    <label class="onoffswitch-label" for="enable_supportagent"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning">
                                                    <?= _l('support_agent_note'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Notification sound settings -->
                                    <div role="tabpanel" class="tab-pane" id="notification_sound">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="enable_notification_sound"><?php echo _l('enable_whatsapp_notification_sound'); ?></label>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" value="1" class="onoffswitch-checkbox" id="enable_wtc_notification_sound" name="settings[enable_wtc_notification_sound]" <?php echo ('1' == get_option('enable_wtc_notification_sound')) ? 'checked' : ''; ?>>
                                                    <label class="onoffswitch-label" for="enable_wtc_notification_sound"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- AI integration settings -->
                                    <div role="tabpanel" class="tab-pane" id="ai_integration">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="enable_wb_openai"><?php echo _l('enable_wb_openai'); ?></label>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" value="1" class="onoffswitch-checkbox" id="enable_wb_openai" name="settings[enable_wb_openai]" <?php echo ('1' == get_option('enable_wb_openai')) ? 'checked' : ''; ?>>
                                                    <label class="onoffswitch-label" for="enable_wb_openai"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo render_input('settings[wb_open_ai_key]', 'open_ai_secret_key', get_option('wb_open_ai_key')); ?>
                                            </div>
                                        </div>
                                        <div class="row openai_model">
                                            <div class="col-md-6">
                                                <?php echo render_select('settings[wb_openai_model]', config_item('openai_models'), ['key', 'value'], 'chat_model', get_option('wb_openai_model'), [], [], '', '', false); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Auto clear chat history settings -->
                                    <div role="tabpanel" class="tab-pane" id="clear_chat_history">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="enable_clear_chat_history"><?php echo _l('enable_auto_clear_chat_history'); ?></label>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" value="1" class="onoffswitch-checkbox" id="enable_clear_chat_history" name="settings[enable_clear_chat_history]" <?php echo ('1' == get_option('enable_clear_chat_history')) ? 'checked' : ''; ?>>
                                                    <label class="onoffswitch-label" for="enable_clear_chat_history"></label>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="settings[wb_auto_clear_time]" class="control-label"><?php echo _l('auto_clear_time'); ?></label>
                                                <div class="input-group">
                                                    <input type="number" id="settings[wb_auto_clear_time]" name="settings[wb_auto_clear_time]" class="form-control" min='1' value="<?php echo get_option('wb_auto_clear_time'); ?>">
                                                    <span class="input-group-addon"><?= _l('days'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning">
                                                    <?= _l('clear_chat_history_note'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">
                                                    This feature requires a properly configured cron job. Before activating the feature, make sure that the <a
                                                        href="<?php echo admin_url('settings?group=cronjob'); ?>">cron job</a> is configured as explanation in
                                                    the documentation.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- AI Assitent settings -->
                                    <div role="tabpanel" class="tab-pane" id="ai_assistent">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="enable_ai_assistant"><?php echo _l('enable_ai_assistant'); ?></label>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" value="1" class="onoffswitch-checkbox" id="enable_ai_assistant" name="settings[enable_ai_assistant]" <?php echo ('1' == get_option('enable_ai_assistant')) ? 'checked' : ''; ?>>
                                                    <label class="onoffswitch-label" for="enable_ai_assistant"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo render_input('settings[stop_ai_assistant]', 'stop_ai_assistant', get_option('stop_ai_assistant')); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="range-container tw-flex tw-gap-6 tw-items-center tw-justify-between">
                                                    <div class="tw-flex tw-flex-col tw-justify-center width400">
                                                        <label for="temperature" class="form-label"><i class="fa-regular fa-circle-question tw-mt-0.5 tw-mr-1" data-toggle="tooltip" data-title="<?php echo _l('temperature_note'); ?>" data-placement="top"></i><?php echo _l('temperature'); ?></label>
                                                        <input type="range" name="settings[pa_temperature]" id="temperature" min="0.1" max="2.0" step="0.1" value="<?= get_option('pa_temperature') ?>" oninput="updateValue('temperature', this.value)">
                                                    </div>
                                                    <div class="tw-border tw-border-neutral-300/80 tw-border-solid tw-px-4 tw-py-1 tw-rounded">
                                                        <span class="range-value" id="temperature-value"><?= get_option('pa_temperature') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo render_select('settings[wb_pa_model]', config_item('openai_models') ?? [], ['key', 'value'], 'ai_model', get_option('wb_pa_model'), [], [], '', '', false); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="range-container tw-flex tw-gap-6 tw-items-center tw-justify-between">
                                                    <div class="tw-flex tw-flex-col tw-justify-center width400">
                                                        <label for="max-token" class="form-label"><i class="fa-regular fa-circle-question tw-mt-0.5 tw-mr-1" data-toggle="tooltip" data-title="<?php echo _l('max_tokens_note'); ?>" data-placement="top"></i><?php echo _l('max_token'); ?></label>
                                                        <input type="range" name="settings[pa_max_token]" id="max-token" min="1" max="4096" step="1" value="<?= get_option('pa_max_token') ?>" oninput="updateValue('max-token', this.value)">
                                                    </div>
                                                    <div class="tw-border tw-border-neutral-300/80 tw-border-solid tw-px-4 tw-py-1 tw-rounded">
                                                        <span class="range-value" id="max-token-value"><?= get_option('pa_max_token') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Session management settings -->
                                    <div role="tabpanel" class="tab-pane" id="session_management">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="enable_session_management"><?php echo _l('enable_session_management'); ?></label>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" value="1" class="onoffswitch-checkbox" id="enable_session_management" name="settings[enable_session_management]" <?php echo ('1' == get_option('enable_session_management')) ? 'checked' : ''; ?>>
                                                    <label class="onoffswitch-label" for="enable_session_management"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo render_textarea('settings[session_expiry_message]', 'session_expiry_message', get_option('session_expiry_message')); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="settings[session_expiry_hours]" class="control-label"><?php echo _l('session_expiry_hours'); ?></label>
                                                <div class="input-group">
                                                    <input type="number" id="settings[session_expiry_hours]" name="settings[session_expiry_hours]" class="form-control" min='1' max='23' value="<?php echo get_option('session_expiry_hours'); ?>">
                                                    <span class="input-group-addon"><?= _l('hours'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Opt in-out settings -->
                                    <div role="tabpanel" class="tab-pane" id="opt_out_settings">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="enable_session_management"><?php echo _l('enable_opt_out'); ?></label>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" value="1" class="onoffswitch-checkbox" id="enable_opt_out" name="settings[enable_opt_out]" <?php echo ('1' == get_option('enable_opt_out')) ? 'checked' : ''; ?>>
                                                    <label class="onoffswitch-label" for="enable_opt_out"></label>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 trigger_input">
                                                <label for="trigger" class="control-label"><?php echo _l('trigger_keyword_to_opt_out'); ?></label>
                                                <input type="text" class="tagsinput" id="trigger" name="settings[opt_out_keyword]" value="<?= get_option('opt_out_keyword'); ?>" data-role="tagsinput">
                                            </div>
                                            <div class="col-md-12">
                                                <?php echo render_input('settings[opt_out_message]', 'message_for_opt_out', get_option('opt_out_message')); ?>
                                            </div>
                                            <div class="form-group col-md-12 trigger_input">
                                                <label for="trigger" class="control-label"><?php echo _l('trigger_keyword_to_opt_in'); ?></label>
                                                <input type="text" class="tagsinput" id="trigger" name="settings[opt_in_keyword]" value="<?= get_option('opt_in_keyword'); ?>" data-role="tagsinput">
                                            </div>
                                            <div class="col-md-12">
                                                <?php echo render_input('settings[opt_in_message]', 'message_for_opt_in', get_option('opt_in_message')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (($group['without_submit_button'] ?? false) !== true) { ?>
                                <div class="panel-footer text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <?= _l('settings_save'); ?>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="new_version"></div>

<div class="modal fade" id="webhook_json_maping" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="heading_text" class="modal-title"><?= _l('webhook_payload_data'); ?><h4>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                <div class="container-fluid" id="jsonContainer">
                    <!-- Rows will be appended here -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>


<script>
    $(function() {

        $("body").find(".custom-tabs li").removeClass("active");
        $("body")
            .find('.custom-tabs [data-group="whatsbot"]')
            .parents("li")
            .addClass("active");


        tab_active = get_url_param("tab");

        var $navTabs = $("body").find("ul.custom-tabs");

        // Check for active tab if any found in url so we can set this tab to active - Tab active is defined on top
        if (tab_active) {
            $navTabs.find('[href="#' + tab_active + '"]').click();
        }

        // Check for active tab groups (this is custom made) and not related to boostrap - tab_group is defined on top
        if (tab_group) {
            // Do not track bootstrap default tabs
            $navTabs.find("li").not('[role="presentation"]').removeClass("active");
            // Add the class active to this group manually so the tab can be highlighted
            $navTabs
                .find('[data-group="' + tab_group + '"]')
                .parents("li")
                .addClass("active");
        }


        const tabNameMap = {
            'notification_sound': 'Notification Sound',
            'opt_out_settings': 'Opt In-Out Settings',
            'session_management': 'WhatsApp Session Management',
            'ai_integration': 'AI Integration',
            'ai_assistent': 'AI Assistant',
            'clear_chat_history': 'Auto Clear Chat History',
            'supportagent': 'Support Agent',
            'whatsapp_auto_lead': 'Whatsapp Auto Lead',
            'webhooks': 'WebHooks (Re send)',
            'webhooks_receive': "WebHooks Receive"
        };

        // Get the active tab pane and update tab name on load
        const activeTab = document.querySelector('.tab-pane.active');
        if (activeTab) {
            const activeTabId = activeTab.id;
            const tabDisplayName = tabNameMap[activeTabId] || activeTabId;
            $('#tabname').html(tabDisplayName);
        }

        var settingsForm = $('#settings-form');


        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            if (settingsForm.hasClass('custom-update-url')) return;

            const tabId = $(this).attr('href').slice(1);
            const tabDisplayName = tabNameMap[tabId] || tabId;

            settingsForm.attr('action',
                '<?= site_url($this->uri->uri_string()); ?>?group=whatsbot&active_tab=' + tabId);

            $('#tabname').html(tabDisplayName);
        });

        $(".copy_url").click(function() {
            var text = $(this).data("clipboard-text");
            navigator.clipboard.writeText(text)
                .then(() => {
                    alert_float("success", "Text copied to clipboard!");
                })
        });

        $(".add_row").click(function() {
            $("button[type='submit']").click();
        });

        // Appending data on modal
        $(".webhook_json_modal").click(function() {
            var id = $(this).data("source_id");

            $.ajax({
                type: "post",
                url: `${admin_url}whatsbot/whatsbot_settings/get_webhook_source_data/${id}`,
                dataType: "json",
                success: function(response) {
                    if (!response.response_json) {
                        $('#jsonContainer').html('<div class="alert alert-warning">No  data available.</div>');
                        $('#webhook_json_maping').modal('show');
                        return;
                    }
                    let data;
                    try {
                        data = JSON.parse(response.response_json);
                    } catch (e) {
                        $('#jsonContainer').html('<div class="alert alert-warning">No data available.</div>');
                        $('#webhook_json_maping').modal('show');
                        return;
                    }
                    const flat = flattenJSON(data);
                    const container = $('#jsonContainer');
                    $.each(flat, function(key, value) {
                        var row = $('<div class="row mbot10"></div>');
                        row.append('<div class="col-xs-4 text-left" style="word-break: break-all;">' + $('<div/>').text(key).html() + '</div>');
                        row.append('<div class="col-xs-6 text-left" style="word-break: break-all;">' + $('<div/>').text(value).html() + '</div>');
                        row.append('<div class="col-xs-2 text-right"><button class="btn btn-xs copy-btn" data-key="{' + key + '}">Copy</button></div>');

                        container.append(row);
                    });

                    $('#webhook_json_maping').modal('show');
                }
            });
        });
        $(document).on('click', '.copy-btn', function() {

            var btn = $(this);
            const key = $(this).data('key');
            navigator.clipboard.writeText(key)
                .then(() => {
                    btn.text('Copied!').delay(1000).queue(function(next) {
                        btn.text('Copy');
                        next();
                    });
                });
        });

        $('#webhook_json_maping').on('hidden.bs.modal', function() {
            $('#jsonContainer').html('');
        });

    });

    function flattenJSON(obj, parentKey = '', result = {}) {
        if (typeof obj !== 'object' || obj === null) {
            result[parentKey] = obj;
            return result;
        }

        for (const key in obj) {
            if (!obj.hasOwnProperty(key)) continue;

            const newKey = parentKey ? `${parentKey}.${key}` : key;

            if (typeof obj[key] === 'object' && !Array.isArray(obj[key])) {
                flattenJSON(obj[key], newKey, result);
            } else if (Array.isArray(obj[key])) {
                obj[key].forEach((item, index) => {
                    flattenJSON(item, `${newKey}[*]`, result);
                });
            } else {
                result[newKey] = obj[key];
            }
        }

        return result;
    }
    function updateValue(id, value) {
        document.getElementById(id + '-value').innerText = value;
    }
</script>

<?php hooks()->do_action('settings_group_end', $group); ?>
</body>

</html>
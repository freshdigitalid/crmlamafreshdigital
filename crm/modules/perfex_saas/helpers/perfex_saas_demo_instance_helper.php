<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Get the instances marked as demo.
 * Return array of slug of the instances.
 *
 * @return array
 */
function perfex_saas_demo_instances()
{
    $key = 'perfex_saas_demo_instance';
    $instances = get_option($key);
    $instances = empty($instances) ? [] : json_decode($instances);
    return $instances;
}

/**
 * Get the client id of the demo instances
 *
 * @return array
 */
function perfex_saas_demo_instances_clients()
{
    $demo_instances = perfex_saas_demo_instances();

    // Ensure $demo_instances is an array
    if (is_array($demo_instances) && count($demo_instances) > 0) {

        $CI = &get_instance();
        $CI->db->select('clientid');
        $CI->db->from(perfex_saas_table('companies'));
        $CI->db->where_in('slug', $demo_instances);  // 'slug IN (...)'
        $query = $CI->db->get();
        return array_column($query->result_array(), 'clientid');
    }

    return [];
}

/**
 * Check if the logged client is demo account
 *
 * @param mixed $clientid
 * @return bool
 */
function perfex_saas_client_is_demo_account($clientid = null)
{
    $clientid = $clientid ?? (string)get_client_user_id();
    return  /*!is_admin() && */ is_client_logged_in() && in_array($clientid, perfex_saas_demo_instances_clients());
}

/**
 * Function to manage demo instances resetting.
 *
 * @return void
 */
function perfex_saas_reset_demo_instances()
{
    $CI = &get_instance();

    $key = 'perfex_saas_demo_instance';
    $reset_key = $key . '_reset_hour';
    $history_key = $key . '_last_reset_time';

    $hours_interval = get_option($reset_key);
    $last_reset_stamp = (int)get_option($history_key);
    if (!empty($last_reset_stamp)) {
        // Check if hours interval has elapsed otherwise return
        $diff = time() - $last_reset_stamp;
        $hours_elapsed = $diff / 3600; // Convert the difference to hours

        if ($hours_elapsed < $hours_interval) {
            return; // Interval has not elapsed, exit the function
        }
    }

    $instances = perfex_saas_demo_instances();

    foreach ($instances as $slug) {
        $company = $CI->perfex_saas_model->get_company_by_slug($slug);
        if (empty($company->slug)) continue;

        // Check if restore file exist to use or generate one
        try {
            perfex_saas_remove_company($company, true);
            perfex_saas_deploy_company($company, true);
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
        }
    }

    // Update the last reset timestamp
    update_option($history_key, time());
}

/**
 * Check if a the active tenant or given tenant is marked as demo instance.
 *
 * @param object|null $tenant
 * @return bool
 */
function perfex_saas_tenant_is_demo_instance(object $tenant = null)
{
    if (perfex_saas_is_tenant()) {
        $tenant = $tenant ?? perfex_saas_tenant();
        $instances = perfex_saas_tenant_get_super_option('perfex_saas_demo_instance');
        $instances = empty($instances) ? [] : json_decode($instances);
        return !empty($tenant->slug) && in_array($tenant->slug, $instances);
    }

    if (!$tenant || empty($tenant->slug)) return false;

    return in_array($tenant->slug, perfex_saas_demo_instances());
}

/**
 * Function to render the demo instance credentials on demo instances
 *
 * @return void
 */
function perfex_saas_render_demo_instance_credentials()
{

    if (!perfex_saas_tenant_is_demo_instance()) return;

    $CI = &get_instance();
    $credentials = (array)json_decode(perfex_saas_tenant_get_super_option('perfex_saas_demo_instance_credentials') ?? '', true);
    $credentials = array_filter($credentials, fn ($a) => !empty($a));
    $CI->load->view(
        PERFEX_SAAS_MODULE_NAME . '/includes/demo_instance_credentials',
        [
            'credentials' => $credentials,
            'note' => perfex_saas_tenant_get_super_option('perfex_saas_demo_instance_credentials_note')
        ]
    );
}
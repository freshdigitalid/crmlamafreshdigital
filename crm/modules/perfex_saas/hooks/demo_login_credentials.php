<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!$is_tenant) return;

hooks()->add_action('clients_login_form_end', 'perfex_saas_render_demo_instance_credentials');
hooks()->add_action('before_admin_login_form_close', 'perfex_saas_render_demo_instance_credentials');
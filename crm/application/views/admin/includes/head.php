<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $isRTL = (is_rtl() ? 'true' : 'false'); ?>

<!DOCTYPE html>
<html lang="<?= e($locale); ?>" dir="<?= ($isRTL == 'true') ? 'rtl' : 'ltr' ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?= $title ?? get_option('companyname'); ?></title>

    <?= app_compile_css(); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>window.jQuery = window.$ = jQuery;</script>

    <?php render_admin_js_variables(); ?>

    <script>
        var totalUnreadNotifications = <?= e($current_user->total_unread_notifications); ?>,
            proposalsTemplates = <?= json_encode(get_proposal_templates()); ?>,
            contractsTemplates = <?= json_encode(get_contract_templates()); ?>,
            billingAndShippingFields = ['billing_street', 'billing_city', 'billing_state', 'billing_zip', 'billing_country', 'shipping_street', 'shipping_city', 'shipping_state', 'shipping_zip', 'shipping_country'],
            isRTL = '<?= e($isRTL); ?>',
            taskid, taskTrackingStatsData, taskAttachmentDropzone, taskCommentAttachmentDropzone, newsFeedDropzone,
            expensePreviewDropzone, taskTrackingChart, cfh_popover_templates = {},
            _table_api;
    </script>

    <?php app_admin_head(); ?>

    <script>
        // Menunggu halaman siap sepenuhnya
        $(document).ready(function() {
            console.log("Fix Script Berjalan...");

            // A. Memperbaiki fungsi CSRF yang hilang (Penyebab utama error baris 72)
            if (typeof csrf_jquery_ajax_setup !== "function") {
                console.log("Fungsi csrf_jquery_ajax_setup hilang, membuat manual...");
                window.csrf_jquery_ajax_setup = function() {
                    // Cek apakah variabel csrfData tersedia dari PHP
                    if (typeof csrfData !== 'undefined') {
                        $.ajaxSetup({
                            data: {
                                [csrfData['token_name']]: csrfData['hash']
                            }
                        });
                        console.log("CSRF Setup Manual Berhasil.");
                    } else {
                        console.warn("csrfData tidak ditemukan.");
                    }
                };
            }

            // Jalankan fungsinya
            csrf_jquery_ajax_setup();

            // B. Fix tombol Delete/Action yang menggunakan class '_delete'
            $(document).on('click', '._delete', function(e) {
                if(!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>

</head>

<body <?= admin_body_class($bodyclass ?? ''); ?>>

    <?php hooks()->do_action('after_body_start'); ?>

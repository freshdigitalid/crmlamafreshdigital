<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-s">
                        <div class="panel-body">
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <h4 class="tw-my-0 tw-font-semibold">
                                    <?php echo _l('opted_out'); ?>
                                </h4>
                            </div>
                            <div class="clearfix"></div>
                            <hr class="hr-panel-separator">
                            <div class="panel-table-full">
                                <?php
                                render_datatable([
                                    _l('the_number_sign'),
                                    _l('name'),
                                    _l('email'),
                                    _l('phone'),
                                    _l('type'),
                                    _l('rm_opt_out'),
                                ], 'opted_out_table');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>

<script>
    initDataTable('.table-opted_out_table', '<?= admin_url(WHATSBOT_MODULE . '/optout/table'); ?>');

    $(document).on('change', '.optout_checkbox', function() {
        $.ajax({
            type: "post",
            url: '<?= admin_url(WHATSBOT_MODULE . '/optout/toggle_optout') ?>',
            data: {
                id: $(this).data('id'),
                type: $(this).data('type'),
            },
            dataType: "json",
            success: function(response) {
                alert_float(response.type, response.message);
                $('.table-opted_out_table').DataTable().ajax.reload();
            }
        });
    });
</script>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
    <div class="panel_s">
        <div class="panel-body">
            <div class="_buttons tw-mb-4">
                <?php if (staff_can('create', 'invoices')) { ?>
                    <a href="<?= admin_url('invoices/invoice'); ?>" class="btn btn-primary">
                        <i class="fa-regular fa-plus tw-mr-1"></i>
                        <?= _l('create_new_invoice'); ?>
                    </a>
                <?php } ?>
            </div>
            
            <div class="clearfix"></div>
            <hr class="hr-panel-heading" />

            <div class="col-md-12" id="small-table">
                <?php $this->load->view('admin/invoices/table_html'); ?>
            </div>

            <div class="col-md-7 small-table-right-col">
                <div id="invoice" class="hide"></div>
            </div>
        </div>
    </div>
</div>

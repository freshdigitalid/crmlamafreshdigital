<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<table class="table table-invoices dataTable no-footer dtr-inline" id="invoices_table_manual">
    <thead>
        <tr>
            <th>#Invoice</th>
            <th>Amount</th>
            <th>Total Tax</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Project</th>
            <th>Tags</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        </tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Cek apakah jQuery sudah siap
    if (typeof $ !== 'undefined') {
        if (!$.fn.DataTable.isDataTable('#invoices_table_manual')) {
             $('.table-invoices').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo admin_url('invoices/table'); ?>",
                    "type": "POST",
                    "data": function(d) {
                        // Kirim token CSRF manual jika perlu
                        if(typeof csrfData !== 'undefined') {
                            d[csrfData['token_name']] = csrfData['hash'];
                        }
                    },
                    "error": function(xhr, error, thrown) {
                        console.log("Error AJAX:", xhr.responseText);
                        alert("Terjadi kesalahan saat memuat data. Cek Console (F12) untuk detail.");
                    }
                },
                "columns": [
                    { "data": "number" },   // 0
                    { "data": "total" },    // 1
                    { "data": "total_tax" },// 2
                    { "data": "date" },     // 3
                    { "data": "clientname" }, // 4
                    { "data": "project_name" }, // 5
                    { "data": "tags" },     // 6
                    { "data": "duedate" },  // 7
                    { "data": "status" }    // 8
                ]
            });
        }
    }
});
</script>

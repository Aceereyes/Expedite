<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Messages
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            $messages = \App\Models\CRM\Message::notDone()->get();
                            foreach($messages as $message) {
?>
                                <tr>
                                    <td><?= $message->name; ?></td>
                                    <td><?= $message->email; ?></td>
                                    <td><?= $message->subject; ?></td>
                                    <td>
                                        <a href="<?= createURL('admin_crm_messages_view.php', ['id' => $message->id]); ?>" class="btn mx-1 rounded-pill px-3 py-1 btn-secondary"><i class="ti ti-eye"></i> View</a>
                                    </td>
                                </tr>
<?php
                            }
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?= plugins('DataTables/datatables.css'); ?>">
<script>
    $(function () {
        $("#table").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
        }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
    });
</script>
<script src="<?= plugins('DataTables/datatables.js'); ?>"></script>
<?php
    include('includes/admin_footer.php');
?>
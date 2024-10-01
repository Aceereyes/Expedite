<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Freelancers
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
                                <th>Registration Date</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            $freelancers = \App\Models\Freelancer::all();
                            foreach($freelancers as $freelancer) {
?>
                                <tr>
                                    <td><?= $freelancer->fullName(); ?></td>
                                    <td><?= $freelancer->email; ?></td>
                                    <td><?= \Carbon\Carbon::parse($freelancer->created_at)->format('m/d/Y h:i:sA'); ?></td>
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
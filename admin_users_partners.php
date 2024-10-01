<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Partners
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-sm-inline">
                        <a href="<?= base_url("admin_users.php"); ?>" class="btn"><i class="ti ti-arrow-left"></i> Back</a>
                    </span>
                </div>
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
                                <th>Account Status</th>
                                <th>Email Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            $partners = \App\Models\Partner::all();
                            foreach($partners as $partner) {
?>
                                <tr>
                                    <td><?= $partner->name; ?></td>
                                    <td><?= $partner->email; ?></td>
                                    <td><?= \Carbon\Carbon::parse($partner->created_at)->format('m/d/Y h:i:sA'); ?></td>
                                    <td><?= $partner->email; ?></td>
                                    <td><?= $partner->email; ?></td>
                                    <td><a href="admin_users_partner_view.php?id=<?= $partner->id; ?>" class="btn btn-primary">View</a></td>
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
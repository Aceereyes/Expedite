<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Accounts
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_accounts_add.php" class="btn">
                            <i class="ti ti-plus"></i> New
                        </a>
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
                                <th>Email Address</th>
                                <th>Access</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            $admins = \App\Models\Admin::all();
                            foreach($admins as $admin) {
?>
                                <tr>
                                    <td><?= $admin->firstName." ".$admin->lastName; ?></td>
                                    <td><?= $admin->email; ?></td>
                                    <td><?= $admin->department; ?></td>
                                    <td>
                                        <a href="<?= createURL('admin_accounts_edit.php', ['id' => $admin->id]); ?>" class="btn mx-1 rounded-pill px-3 py-1 btn-secondary"><i class="ti ti-pencil"></i> Edit</a>
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

<script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
<script>
    $(document).ready(function () {
        $('.form-select').each((key, element)=> {
            new TomSelect(element);
        });;
    });
</script>
<?php
    include('includes/admin_footer.php');
?>
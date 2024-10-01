<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Careers
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_hr_careers_add.php" class="btn">
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
                <table id="table" class="table table-sm">
                    <thead>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
<?php
                        $employees = \App\Models\HR\Career::all();
                        foreach($employees as $employee) {
                            $description = strip_tags($employee->description);
                            echo "<tr>
                                <td>{$employee->title}</td>
                                <td>{$description}</td>
                                <td>
                                    <a class=\"btn btn-sm btn-primary\" href=\"admin_hr_careers_edit.php?id={$employee->id}\">Edit</a>
                                </td>
                            </tr>";
                        }
?>
                    </tbody>
                </table>
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
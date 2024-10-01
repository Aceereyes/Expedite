<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Frequently Asked Questions
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_crm_faqs_add.php" class="btn">
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
                                <th>Title</th>
                                <th>Content</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            $faqs = \App\Models\CRM\FAQ::all();
                            foreach($faqs as $faq) {
?>
                                <tr>
                                    <td><?= $faq->title; ?></td>
                                    <td><?= strip_tags(substr($faq->content, 0, 150)); ?>...</td>
                                    <td>
                                        <a href="<?= createURL('admin_crm_faqs_edit.php', ['id' => $faq->id]); ?>" class="btn mx-1 rounded-pill px-3 py-1 btn-secondary"><i class="ti ti-pencil"></i> Edit</a>
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
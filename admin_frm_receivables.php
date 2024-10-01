<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Receivables
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
                                <th>Partner</th>
                                <th>Freelancer</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            $receivables = \App\Models\FRM\Receivable::all();
                            foreach($receivables as $receivable) {
?>
                                <tr>
                                    <td><?= $receivable->partner->name; ?></td>
                                    <td><?= $receivable->freelancer->fullName(); ?></td>
                                    <td>PHP <?= number_format($receivable->amount, 2); ?></td>
                                    <td>
                                        <a href="<?= createURL('admin_frm_receivables_view.php', ['id' => $receivable->id]); ?>" class="btn p-1 mx-1 rounded-pill btn-primary"><i class="ti ti-eye"></i> View</a>
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
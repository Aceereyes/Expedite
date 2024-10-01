<?php
    include('includes/admin_header.php');

    $fr = isset($_GET['fr']) ? \Carbon\Carbon::parse($_GET['fr']) : \Carbon\Carbon::now()->subDays(14);
    $to = isset($_GET['to']) ? \Carbon\Carbon::parse($_GET['to']) : \Carbon\Carbon::now();
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Attendances
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_hr_attendances_add.php" class="btn">
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
<?php
        if(!isset($_GET['sa'])) {
?>
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label>From</label>
                                <input type="date" class="form-control" value="<?= $fr->format('Y-m-d'); ?>" name="fr">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label>To</label>
                                <input type="date" class="form-control" value="<?= $to->format('Y-m-d'); ?>" name="to">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3 text-center">
                                <label class="d-block">&nbsp;</label>
                                <button class="btn btn-primary w-100">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
<?php
        }
?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>No. of Hrs</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            $attendances = \App\Models\HR\Attendance::whereBetween('attendance_date', [$fr->format('Y-m-d'), $to->format('Y-m-d')]);
                            if (isset($_GET['emp'])) {
                                $attendances->where('employee_id', '=', $_GET['emp']);
                            }
                            if (isset($_GET['type'])) {
                                $attendances->where('type', '=', $_GET['type']);
                            }
                            $attendances = $attendances->get();

                            foreach($attendances as $attendance) {
?>
                                <tr>
                                    <td><?= $attendance->employee->fullName(); ?></td>
                                    <td><?= date_format(new DateTime($attendance->attendance_date), 'F d, Y'); ?></td>
                                    <td><?= $attendance->type; ?></td>
                                    <td><?= date_format(new DateTime($attendance->timeIn), 'h:i:s A'); ?></td>
                                    <td><?= date_format(new DateTime($attendance->timeOut), 'h:i:s A'); ?></td>
                                    <td><?= $attendance->noOfHours; ?> hrs</td>
                                    <td><?= $attendance->remarks;?></td>
                                    <td>
                                        <a href="<?= createURL('admin_hr_attendances_edit.php', ['id' => $attendance->id]); ?>" class="btn p-1 mx-1 rounded-pill btn-secondary"><i class="ti ti-eye"></i> Edit</a>
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
<script src="<?= plugins('DataTables/datatables.js'); ?>"></script>
<script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
<script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
<script>
    $(function () {
        $("#table").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
        }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
    });
    $(document).ready(function () {
        $('.form-select').each((key, element)=> {
            new TomSelect(element);
        });

        let options = {
            selector: '#remarks',
            height: 200,
            menubar: 'insert | format',
            promotion: false,
            statusbar: false,
            readonly: false,
            plugins: 'image',
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
        }
        if (localStorage.getItem("tablerTheme") === 'dark') {
            options.skin = 'oxide-dark';
            options.content_css = 'dark';
        }
        tinyMCE.init(options);
    });
</script>
<?php
    include('includes/admin_footer.php');
?>
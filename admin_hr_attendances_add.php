<?php
    include('includes/admin_header.php');

    if(isset($_POST['btnCreate'])) {
        $data = \App\Models\HR\Attendance::create([
            'employee_id' => $_POST['employee'],
            'type' => $_POST['type'],
            'attendance_date' => $_POST['attDate'],
            'timeIn' => $_POST['timeIn'],
            'timeOut' => $_POST['timeOut'],
            'noOfHours' => $_POST['noOfHours'],
            'remarks' => $_POST['remarks'],
        ]);

        setFlashMessage('success', 'Attendance has been added successfully!');
        redirect('admin_hr_attendances.php');
        exit();
    }
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Add Attendance
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_hr_attendances.php" class="btn">
                            <i class="ti ti-arrow-back"></i> Back
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
                <form method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <label class="form-label">Employee</label>
                                <select name="employee" class="tomselect form-select" required>
<?php
                                    $employees = \App\Models\HR\Employee::all();
                                    foreach($employees as $employee) {
                                        echo '<option value="'.$employee->id.'">'.$employee->fullName().'</option>';
                                    }
?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="tomselect form-select" required>
<?php
                                    foreach(config('app.attendance.types') as $type) {
                                        echo '<option value="'.$type.'">'.$type.'</option>';
                                    }
?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="attDate" value="<?= date('Y-m-d'); ?>" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Time In</label>
                                <input type="time" name="timeIn" value="00:00" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Time Out</label>
                                <input type="time" name="timeOut" value="00:00" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">No. of Hours</label>
                                <input type="number" step="1" value="0" name="noOfHours" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" id="remarks"></textarea>
                    </div>
                    <div class="mt-3 mb-3 text-center">
                        <button type="submit" name="btnCreate" class="btn btn-primary px-5">Create Attendance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
<script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
<script>
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
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
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
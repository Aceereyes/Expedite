<?php
    include('includes/admin_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Attendance does not exist!');
        redirect('admin_hr_attendances.php');
        exit();
    }
    
    $attendance = \App\Models\HR\Attendance::find($_GET['id']);

    if(isset($_POST['btnUpdate'])) {
        $attendance->update([
            'type' => $_POST['type'],
            'attendance_date' => $_POST['attDate'],
            'timeIn' => $_POST['timeIn'],
            'timeOut' => $_POST['timeOut'],
            'noOfHours' => $_POST['noOfHours'],
            'remarks' => $_POST['remarks']
        ]);
        setFlashMessage('success', 'Attendance has been updated successfully!');
        redirect('admin_hr_attendances.php');
        exit();
    }
    else if(isset($_POST['btnConfirmDelete'])) {
        $attendance->delete();
        setFlashMessage('success', 'Attendance has been deleted successfully!');
        redirect('admin_hr_attendances.php');
        exit(); 
    }
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Edit Attendance
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
                                <select name="employee" class="tomselect form-select" disabled>
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
                                        $selected = ($type == $attendance->type) ? 'selected' : '';
                                        echo "<option value=\"$type\" $selected>$type</option>";
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
                                <input type="date" name="attDate" value="<?= \Carbon\Carbon::parse($attendance->attendance_date)->format('Y-m-d') ?>" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Time In</label>
                                <input type="time" name="timeIn" value="<?= \Carbon\Carbon::parse($attendance->timeIn)->format('H:i:s') ?>" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Time Out</label>
                                <input type="time" name="timeOut" value="<?= \Carbon\Carbon::parse($attendance->timeOut)->format('H:i:s') ?>" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">No. of Hours</label>
                                <input type="number" step="1" value="<?= $attendance->noOfHours ?>" name="noOfHours" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" id="remarks"><?= $attendance->remarks; ?></textarea>
                    </div>
                    <div class="mt-3 mb-3 text-center">
                        <button type="submit" name="btnUpdate" class="btn btn-primary px-5">Update Attendance</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_confirmdelete" class="btn btn-danger px-5 mx-4">Delete Attendance</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>
<div class="modal modal-blur fade" id="modal_confirmdelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this account?</p>
            </div>
            <div class="modal-footer">
                <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                <button type="submit" name="btnConfirmDelete" class="btn btn-danger">Yes</button>
            </div>
        </form>
    </div>
</div>
<div class="modal modal-blur fade" id="modal_resetPassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reset this account's password?</p>
            </div>
            <div class="modal-footer">
                <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                <button type="submit" name="btnResetPassword" class="btn btn-warning">Yes</button>
            </div>
        </form>
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
<?php
    include('includes/freelancer_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Record does not exist!');
        //alert('Account does not exist!');
        redirect('freelancer_profile_academic.php');
        exit();
    }

    $record = \App\Models\Freelancer\AcademicQualification::find($_GET['id']);

    if(isset($_POST['btnUpdate'])) {
        $record->update([
            'level' => $_POST['level'],
            'institution' => $_POST['institution'],
            'course' => $_POST['course'],
            'timeframe' => $_POST['timeframe']
        ]);
        setFlashMessage('success', 'Record has been updated successfully!');
        refresh();
        exit();
    }
    else if(isset($_POST['btnConfirmDelete'])) {
        $record->delete();
        setFlashMessage('success', 'Record has been deleted successfully!');
        redirect('freelancer_profile_academic.php');
        exit(); 
    }
?>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="col-3 d-md-block border-end">
                        <div class="card-body">
<?php
                            include('includes/freelancer_profile_sidebar.php');
?>
                        </div>
                    </div>
                    <form method="POST" class="col d-flex flex-column">
                        <div class="card-body pb-4">
                            <div class="row g-2 align-items-center mb-3">
                                <div class="col">
                                    <h2 class="page-title">Academic Qualification</h2>
                                </div>
                                <div class="col-auto ms-auto d-print-none">
                                    <a href="freelancer_profile_academic.php" class="btn">
                                        <i class="ti ti-arrow-back"></i> Back
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Education Level</label>
                                <select class="form-select" name="level" required>
<?php
                                    foreach(\App\Models\Freelancer\AcademicQualification::LEVELS as $level) {
                                        $selected = ($record->level == $level) ? 'selected' : '';
                                        echo "<option value=\"$level\" $selected>$level</option>";
                                    }
?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Institution Name</label>
                                <input type="text" class="form-control" value="<?= $record->institution ?>" name="institution" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course Title</label>
                                <input type="text" class="form-control" value="<?= $record->course ?>" name="course" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Time Frame</label>
                                <input type="text" class="form-control" value="<?= $record->timeframe ?>" name="timeframe" required>
                            </div>
                        </div>
                        <div class="mt-3 mb-3 text-center">
                            <button type="submit" name="btnUpdate" class="btn btn-primary px-5 mx-4">Update</button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal_confirmdelete" class="btn btn-danger px-5 mx-4">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
    <!-- Delete the record -->
    <div class="modal modal-blur fade" id="modal_confirmdelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                    <button type="submit" name="btnConfirmDelete" class="btn btn-danger">Yes</button>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
    <script>
        $(document).ready(function () {
            $('.form-select').each((key, element)=> {
                new TomSelect(element);
            });
        });
    </script>
<?php
    include('includes/freelancer_footer.php');
?>
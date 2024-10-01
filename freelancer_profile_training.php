<?php
    include('includes/freelancer_header.php');
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
                    <div method="POST" class="col d-flex flex-column" enctype="multipart/form-data">
                        <div class="card-body pb-4">
                            <div class="row g-2 align-items-center mb-3">
                                <div class="col">
                                    <h2 class="page-title">Training & Workshop Attended</h2>
                                </div>
                                <div class="col-auto ms-auto d-print-none">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal_add" class="btn">
                                        <i class="ti ti-plus"></i> Add
                                    </a>
                                </div>
                            </div>
<?php
                            $academicQualifications = \App\Models\Freelancer\TrainingAndWorkshop::where('freelancer_id', freelancer()->id)->get();
                            if($academicQualifications->count() > 0) {
                                foreach($academicQualifications as $academicQualification) {
?>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="avatar rounded"><?= strtoupper(substr($academicQualification->institution, 0, 2))?></span>
                                                </div>
                                                <div class="col">
                                                    <div class="fw-bold"><?= $academicQualification->training; ?> (<?= $academicQualification->timeframe; ?>)</div>
                                                    <div class="text-muted"><?= $academicQualification->institution ?></div>
                                                </div>
                                                <div class="col-auto ms-auto d-print-none">
                                                    <div class="btn-list">
                                                        <a href="<?= base_url('freelancer_profile_training_edit.php?id='.$academicQualification->id); ?>" class="btn btn-primary d-sm-inline-block">
                                                            Edit
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
<?php
                                }
                            } else {
                                echo '<div class="alert alert-info">There are no records to display.</div>';
                            }
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to Add Record -->
<?php
    if(isset($_POST['btnAdd'])) {
        $academicQualification = \App\Models\Freelancer\TrainingAndWorkshop::create([
            'freelancer_id' => freelancer()->id,
            'institution' => $_POST['institution'],
            'training' => $_POST['training'],
            'timeframe' => $_POST['timeframe']
        ]);
        setFlashMessage('success', 'Training/Workshop added successfully.');
        refresh();
        exit();
    }
?>
    <div class="modal modal-blur fade" id="modal_add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Qualifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Institution Name</label>
                        <input type="text" class="form-control" name="institution" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Training Title</label>
                        <input type="text" class="form-control" name="training" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Time Frame</label>
                        <input type="text" class="form-control" name="timeframe" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
                    <button type="submit" name="btnAdd" class="btn btn-primary">Submit</button>
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
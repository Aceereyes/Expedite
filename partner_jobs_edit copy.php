<?php
    include('includes/partner_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Job does not exist!');
        redirect('partner_jobs.php');
        exit();
    }
    $job = \App\Models\Job::find($_GET['id']);

    if(isset($_POST['btnUpdate'])) {
        $job->update([
            'title' => $_POST['title'],
            'amount' => $_POST['amount'],
            'category' => $_POST['category'],
            'deadline' => $_POST['deadline'],
            'closingDate' => $_POST['closingDate'],
            'experience' => $_POST['experience'],
            'description' => $_POST['description'],
            'responsibilities' => $_POST['responsibilities'],
            'requirements' => $_POST['requirements'],
            'active' => $_POST['active']
        ]);
        setFlashMessage('success', 'Job has been updated successfully!');
        refresh();
        exit();
    }
    else if(isset($_POST['btnConfirmDelete'])) {
        $job->delete();
        setFlashMessage('success', 'Job has been deleted successfully!');
        redirect('partner_jobs.php');
        exit(); 
    }
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    Update Job
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-sm-inline">
                        <a href="<?= base_url('partner_jobs.php'); ?>" class="btn"><i class="ti ti-arrow-back"></i> Back</a>
                    </span>
                </div>
            </div>
        </div>
        <form class="card" method="POST">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="mb-3">
                            <div class="form-label">Job Title</div>
                            <input type="text" class="form-control" value="<?= $job->title; ?>" name="title" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group mb-3">
                            <div class="form-label">Amount</div>
                            <div class="input-group">
                                <span class="input-group-text">
                                    PHP
                                </span>
                                <input type="number" class="form-control" step="0.01" value="<?= $job->amount; ?>" name="amount" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="mb-3">
                            <div class="form-label">Job Posting Closing Date</div>
                            <input type="date" class="form-control" value="<?= \Carbon\Carbon::parse($job->closingDate)->format('Y-m-d') ?>" name="closingDate" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <div class="form-label">Category</div>
                            <select class="form-select" name="category" required>
<?php
                                foreach(config('app.partner.types') as $types) {
                                    $selected = ($types == $job->category) ? 'selected' : '';
                                    echo "<option value=\"$types\" $selected>$types</option>";
                                }
?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <div class="form-label">Experience</div>
                            <select class="form-select" name="experience" required>
<?php
                                foreach(config('freelancer.experience_levels') as $types) {
                                    $selected = ($types == $job->experience) ? 'selected' : '';
                                    echo "<option value=\"$types\" $selected>$types</option>";
                                }
?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <div class="form-label">Status</div>
                            <select class="form-select" name="active" required>
<?php
                                foreach(['Inactive', 'Active'] as $key => $types) {
                                    $selected = ($key == $job->active) ? 'selected' : '';
                                    echo "<option value=\"$key\" $selected>$types</option>";
                                }
?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <div class="form-label">Task Open until</div>
                            <input type="date" class="form-control" value="<?= \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') ?>" name="deadline" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Job Description</div>
                    <textarea name="description" id="description" class="tinyMCE"><?= $job->description; ?></textarea>
                </div>
                <div class="mb-3">
                    <div class="form-label">Job Responsibilities</div>
                    <textarea name="responsibilities" id="responsibilities" class="tinyMCE"><?= $job->responsibilities; ?></textarea>
                </div>
                <div class="mb-3">
                    <div class="form-label">Requirements</div>
                    <textarea name="requirements" id="requirements" class="tinyMCE"><?= $job->requirements; ?></textarea>
                </div>
                <div class="mb-3">
                    <div class="form-label">Instructions for freelancers</div>
                    <textarea name="instructions" id="instructions" class="tinyMCE"><?= $job->requirements; ?></textarea>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" name="btnUpdate" class="btn btn-primary px-5">Update Job</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal_confirmdelete" class="btn btn-danger px-5 mx-4">Delete</button>
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
            selector: '.tinyMCE',
            height: 150,
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
<?php
    include('includes/partner_footer.php');
?>
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
            'category' => $_POST['category'],
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
                
            </div>
            <div class="card-footer text-center">
                <button type="submit" name="btnUpdate" class="btn btn-primary px-5">Update Job</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal_confirmdelete" class="btn btn-danger px-5 mx-4">Delete</button>
            </div>
        </form>
    </div>
</div>
<?php
    include('includes/partner_footer.php');
?>
<?php
    include('includes/partner_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Job does not exist!');
        redirect('partner_dashboard.php');
        exit();
    }
    $job = \App\Models\Job::find($_GET['id']);
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    Applicants
                </h2>
                <h2 class="page-pretitle h4">
                    <?= $job->title ?> at <?= $job->partner->name ?>
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-sm-inline">
                        <a href="<?= base_url('partner_dashboard.php'); ?>" class="btn"><i class="ti ti-arrow-back"></i> Back</a>
                    </span>
                </div>
            </div>
        </div>
<?php
        $applications = $job->applications;
        if($applications->count() > 0) {
            foreach($applications as $job) {
                $freelancer = $job->freelancer;
?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto align-self-center">
                                <div class="badge bg-<?= ($job->color()) ?> badge-blink"></div>
                            </div>
                            <div class="col">
                                <div class="fw-bold"><?= $job->freelancer->fullName(); ?></div>
                                <div class="text-muted"><?= $job->freelancer->address() ?></div>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <a href="<?= base_url("partner_job_applicants_view.php?id=$job->id"); ?>" class="btn btn-primary d-sm-inline-block">View Applicant</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            }
        } else {
            echo "<div class=\"alert alert-info\" role=\"alert\">There are no applicants at the moment.</div>";
        }
?>
    </div>
</div>
<?php
    include('includes/partner_footer.php');
?>
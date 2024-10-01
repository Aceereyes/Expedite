<?php
    include('includes/partner_header.php');
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    Posted Jobs
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-sm-inline">
                        <a href="<?= base_url('partner_jobs_add.php'); ?>" class="btn"><i class="ti ti-plus"></i> New Job</a>
                    </span>
                </div>
            </div>
        </div>
<?php
        $perPage = 10;
        $posted_jobs = \App\Models\Job::where('partner_id', partner()->id)->orderBy('active', 'desc')->paginate($perPage, ['*'], 'page', isset($_GET['page']) ? $_GET['page'] : 1);
        
        if($posted_jobs->count() > 0) {
            foreach($posted_jobs as $job) {
?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto align-self-center">
                                <div class="badge bg-<?= $job->color() ?> badge-blink"></div>
                            </div>
                            <div class="col">
                                <div class="fw-bold"><?= $job->title; ?> (<?= $job->category; ?>)</div>
                                <div class="text-muted">Closing Date: <?= \Carbon\Carbon::parse($job->closingDate)->format('F d, Y'); ?></div>
                                <div class="text-muted">Amount: PHP <?= number_format($job->amount, 2); ?></div>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                <a href="<?= base_url("partner_job_applicants.php?id=$job->id"); ?>" class="btn btn-primary d-sm-inline-block">Applicants</a>
                                    <a href="<?= base_url("partner_jobs_edit.php?id=$job->id"); ?>" class="btn d-sm-inline-block">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            }
?>
            <div class="d-flex justify-content-center">
                <ul class="pagination ">
                    <li class="page-item mx-3">
                        <a class="page-link <?= $posted_jobs->onFirstPage() ? 'disabled' : '' ?>" href="<?= createUrl('partner_jobs.php', array_merge($_GET, ['page' => $posted_jobs->currentPage() - 1])); ?>">
                            <i class="ti chevron-left"></i> Previous
                        </a>
                    </li>
                    <li class="page-item mx-3">
                        <a class="page-link <?= $posted_jobs->onLastPage() ? 'disabled' : '' ?>" href="<?= createUrl('partner_jobs.php', array_merge($_GET, ['page' => $posted_jobs->currentPage() + 1])); ?>">
                            <i class="ti chevron-right"></i> Next
                        </a>
                    </li>
                </ul>
            </div>
<?php
        } else {
            echo "<div class=\"alert alert-info\" role=\"alert\">There are no posted jobs at the moment.</div>";
        }
?>
    </div>
</div>
<?php
    include('includes/partner_footer.php');
?>
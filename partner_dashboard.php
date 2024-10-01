<?php
    include('includes/partner_header.php');
?>
<div class="page-body">
    <div class="container">
<?php
    $perPage = 10;
    $job_orders = \App\Models\JobOrder::where('partner_id', partner()->id)->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', isset($_GET['page']) ? $_GET['page'] : 1);

    if(partner()->initialSetup) {
        echo "<div class=\"alert alert-info\">You must update your profile first before anything else.<br/>
            <b><a href=\"partner_profile.php\">Click here</a></b> to update your profile.
        </div>";
    }
    else if($job_orders->count() > 0) {
?>
        <div class="row">
            <div class="col-sm-9">
                <div class="row g-2 align-items-center mb-3">
                    <div class="col">
                        <h2 class="page-title">
                            Job Orders
                        </h2>
                    </div>
                </div>
<?php
                foreach($job_orders as $job_order) {
?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <div class="badge bg-<?= $job_order->color() ?> badge-blink"></div>
                                </div>
                                <div class="col">
                                    <div class="fw-bold"><?= $job_order->job->title; ?> (<?= $job_order->job->category; ?>)</div>
                                    <div class="text-muted">Freelancer: <b><?= $job_order->freelancer->fullName() ?></b></div>
                                    <div class="text-muted">Deadline: <?= $job_order->getDeadline() ?></div>
                                    <div class="text-muted">Submitted: <?= $job_order->submissionDateTime() ?></div>
                                </div>
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <a href="<?= base_url("partner_job_orders_view.php?id=$job_order->id"); ?>" class="btn btn-primary d-sm-inline-block">View</a>
                                        <!-- <a href="<?= base_url("partner_job_orders_edit.php?id=$job_order->id"); ?>" class="btn d-sm-inline-block">Edit</a> -->
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
                            <a class="page-link <?= $job_orders->onFirstPage() ? 'disabled' : '' ?>" href="<?= createUrl('partner_jobs.php', array_merge($_GET, ['page' => $job_orders->currentPage() - 1])); ?>">
                                <i class="ti chevron-left"></i> Previous
                            </a>
                        </li>
                        <li class="page-item mx-3">
                            <a class="page-link <?= $job_orders->onLastPage() ? 'disabled' : '' ?>" href="<?= createUrl('partner_jobs.php', array_merge($_GET, ['page' => $job_orders->currentPage() + 1])); ?>">
                                <i class="ti chevron-right"></i> Next
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <h2 class="mb-2">Information</h2>
                <div class="card card-sm mb-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <i class="ti ti-currency-peso"></i>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    <?= number_format(partner()->payables->sum('amount'), 2); ?>
                                </div>
                                <div class="text-muted">
                                    Earnings
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-sm mb-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-azure text-white avatar">
                                    <i class="ti ti-file"></i>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    <?= partner()->job_applications->count(); ?>
                                </div>
                                <div class="text-muted">
                                    Applications
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-sm mb-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-green text-white avatar">
                                    <i class="ti ti-file-description"></i>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    <?= partner()->jobs->count(); ?>
                                </div>
                                <div class="text-muted">
                                    Jobs
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-sm mb-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-green text-white avatar">
                                    <i class="ti ti-folder"></i>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    <?= partner()->job_orders->count(); ?>
                                </div>
                                <div class="text-muted">
                                    Job Orders
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<div class=\"alert alert-info\" role=\"alert\">There are no job orders at the moment.</div>";
    }
?>
<?php
    include('includes/partner_footer.php');
?>
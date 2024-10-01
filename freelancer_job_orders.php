<?php
    include('includes/freelancer_header.php');
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    Job Orders
                </h2>
            </div>
        </div>
<?php
        $perPage = 10;
        $job_orders = \App\Models\JobOrder::where('freelancer_id', freelancer()->id)->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', isset($_GET['page']) ? $_GET['page'] : 1);
        if($job_orders->count() > 0) {
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
                                <div class="text-muted">Partner: <b><?= $job_order->partner->name ?></b></div>
                                <div class="text-muted">Deadline: <b><?= $job_order->getDeadline(); ?></b></div>
                                <div class="text-muted">Status: <b><?= $job_order->status; ?></b></div>
                                <div class="text-muted">Submitted on: <?= $job_order->submissionDateTime(); ?></div>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <a href="<?= base_url("freelancer_job_orders_view.php?id=$job_order->id"); ?>" class="btn btn-primary d-sm-inline-block">View</a>
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
                        <a class="page-link <?= $job_orders->onFirstPage() ? 'disabled' : '' ?>" href="<?= createUrl('freelancer_job_orders.php', array_merge($_GET, ['page' => $job_orders->currentPage() - 1])); ?>">
                            <i class="ti chevron-left"></i> Previous
                        </a>
                    </li>
                    <li class="page-item mx-3">
                        <a class="page-link <?= $job_orders->onLastPage() ? 'disabled' : '' ?>" href="<?= createUrl('freelancer_job_orders.php', array_merge($_GET, ['page' => $job_orders->currentPage() + 1])); ?>">
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
    include('includes/freelancer_footer.php');
?>
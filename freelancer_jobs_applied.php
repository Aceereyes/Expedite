<?php
    include('includes/freelancer_header.php');
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">Applied Jobs</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <a href="freelancer_dashboard.php" class="btn">
                    <i class="ti ti-file"></i> Jobs
                </a>
            </div>
        </div>
<?php
        $jobs_applied = \App\Models\JobApplication::orderBy('created_at', 'desc')->get();
        if($jobs_applied->count() > 0) {
?>
            <!-- Card -->
            <div class="row row-cards">
<?php
                if($jobs_applied->count() > 0) {
                    foreach($jobs_applied as $applied) {
                        $job = $applied->job;
?>
                        <a href="freelancer_jobs_view.php?id=<?= $job->id; ?>" class="text-decoration-none text-dark">
                            <div class="card hoverable">
                                <div class="card-body">
                                    <h5 class="card-title m-0 text-primary"><?= $job->title; ?></h5>
                                    <h5 class="m-0"><?= $job->partner->name; ?></h5>
                                    <p class="card-text m-0">
                                        <small>Experience Level: <?= $job->experience; ?> | Est. Budget: PHP <b><?= number_format($job->amount, 2); ?></b> - Posted <?= $job->created_at->diffForHumans(); ?></small>
                                    </p>
                                    <div class="m-0 mt-2"><?= substr(strip_tags($job->description), 0, 200); ?>...</div>
<?php
                                    if(!empty($job->skills)) {
                                        echo '<div class="d-block mt-2">';
                                        foreach(explode(',', $job->skills) as $tag) {
                                            $color = in_array($tag, freelancer()->skillSet()) ? 'bg-blue' : 'badge-outline text-blue';
                                            echo '<span class="badge '.$color.' px-3 me-2 mb-1" href="#">'.$tag.'</span>';
                                        }
                                        echo '</div>';
                                    }
?>
                                    <div class="mt-2">
                                        <i class="ti ti-location"></i> <?= $job->partner->address() ?>
                                    </div>
                                    <div class="mt-2">
                                        Applications: <?= $job->applications->count(); ?>
                                    </div>
                                </div>
                            </div>
                        </a>
<?php
                    }
                } else {
                    echo "<div class=\"alert alert-info\">There are no posted jobs at the moment.</div>";
                }
?>
            </div>
<?php
        } else {
            echo "<div class=\"alert alert-info\">There are no posted jobs at the moment.</div>";
        }
?>
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
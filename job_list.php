<?php
    include('includes/guest_header.php');
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">Jobs for You</h2>
            </div>
        </div>
<?php
        $jobs_posted = \App\Models\Job::all();
        if($jobs_posted->count() > 0) {
?>
            <div class="row g-4">
                <div class="col-md-3">
                    <form method="get" autocomplete="off">
                        <div class="mb-3">
                            <div class="form-label">Category</div>
                            <select class="form-select" name="category" required>
<?php
                                foreach(config('app.partner.skills') as $types => $skills) {
                                    echo "<option value=\"$types\">$types</option>";
                                }
?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Experience</div>
                            <select class="form-select" name="experience" required>
<?php
                                foreach(config('freelancer.experience_levels') as $types) {
                                    echo "<option value=\"$types\">$types</option>";
                                }
?>
                            </select>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary w-100">Confirm</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-9">

                  <!-- Card -->
                    <div class="row row-cards mb-3">
                        <div class="space-y">
<?php
                        $posted_jobs = \App\Models\Job::where('active', 1);
                        if(isset($_GET['category'])) {
                            $posted_jobs->where('category', $_GET['category']);
                        }
                        if(isset($_GET['experience'])) {
                            $posted_jobs->where('experience', $_GET['experience']);
                        }
                        
                        if($posted_jobs->count() > 0) {
                            foreach($posted_jobs->get() as $job) {
?>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-auto align-self-center">
                                                <div class="badge <?= ($job->active) ? 'bg-success' : 'bg-danger' ?>"></div>
                                            </div>
                                            <div class="col fw-bold">
                                                <?= $job->title; ?> (<?= $job->category; ?>)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-block mt-2">
                                                    <p class="m-0 fw-bold">Description</p>
                                                    <p class="m-0"><?= $job->description ?? '-'; ?></p>
                                                </div>
                                                <div class="d-block mt-2">
                                                    <p class="m-0 fw-bold">Responsibilities</p>
                                                    <p class="m-0"><?= $job->responsibilities ?? '-'; ?></p>
                                                </div>
                                                <div class="d-block mt-2">
                                                    <p class="m-0 fw-bold">Requirements</p>
                                                    <p class="m-0"><?= $job->requirements ?? '-'; ?></p>
                                                </div>
                                                <div class="text-muted">Closing Date: <?= \Carbon\Carbon::parse($job->closingDate)->format('F d, Y'); ?></div>
                                            </div>
                                            <div class="col-auto ms-auto d-print-none">
                                                <div class="btn-list">
                                                    <a href="job_view.php?id=<?= $job->id; ?>" class="btn btn-primary d-sm-inline-block">View this Job</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php
                            }
                        } else {
                            echo "<div class=\"alert alert-info\">There are no posted jobs at the moment.</div>";
                        }
?>
                        </div>
                    </div>

                </div>
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
    include('includes/guest_footer.php');
?>
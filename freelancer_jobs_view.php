<?php
    include('includes/freelancer_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Record does not exist!');
        //alert('Account does not exist!');
        redirect('freelancer_profile_work.php');
        exit();
    }
    $job = \App\Models\Job::find($_GET['id']);

    if(isset($_POST['btnConfirmApply'])) {
        if(!\App\Models\JobApplication::isApplied(freelancer()->id, $job->id)) {
            App\Models\JobApplication::create([
                'partner_id' => $job->partner_id,
                'freelancer_id' => freelancer()->id,
                'job_id' => $job->id,
                'status' => 'Pending'
            ]);
            setFlashMessage('success', 'You have successfully applied to this job!');
        } else {
            setFlashMessage('error', 'You have already applied to this job!');
        }
        refresh();
        exit();
    }

    $errors = [];
    if(!$job->hasValidSkills(freelancer())) {
        $errors[] = 'You must have at least one valid skill!';
    }
    if(!$job->isValidSex(freelancer())) {
        $errors[] = 'Your sex is invalid!';
    }
    if(!$job->hasValidLanguages(freelancer())) {
        $errors[] = 'You must have at least one valid language!';
    }
    if(!$job->isValidAge(freelancer())) {
        $errors[] = 'You must be at least '.$job->ageRequirement();
    }
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">View Job</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <a href="freelancer_dashboard.php" class="btn">
                    <i class="ti ti-arrow-back"></i> Back
                </a>
            </div>
        </div>
<?php
        if(!empty($errors)) {
            echo '<div class="alert alert-danger">
                <b>You cannot apply for this job because of the following reasons:</b><br/>
                '.implode('<br/>', $errors).'<br/><br/>
                Update your profile by clicking <a href="freelancer_profile.php">here.</a>
            </div>';
        }
?>
        <div class="card mb-3">
            <div class="card-body pb-4">
                <div class="row align-items-center justify-content-center">
                    <span class="avatar avatar-xl" style="background-image: url('<?= $job->partner->getLogo() ?>')"></span>
                </div>

                <h2 class="text-center h2 mt-4"><?= $job->title ?></h2>
                <h3 class="text-center h3 mt-2 mb-4">at <?= $job->partner->name ?></h3>
                <div class="datagrid">
<?php
                    $datagrid_items = [
                        [
                            'title' => 'Price',
                            'content' => 'PHP '.number_format($job->amount, 2)
                        ],
                        [
                            'title' => 'Age Requirement',
                            'content' => $job->ageRequirement()
                        ],
                        [
                            'title' => 'Sex Requirement',
                            'content' => $job->sex
                        ],
                        [
                            'title' => 'Language Requirement',
                            'content' => $job->language
                        ],
                        [
                            'title' => 'Category',
                            'content' => $job->category,
                        ],
                        [
                            'title' => 'Experience',
                            'content' => $job->experience
                        ],
                        [
                            'title' => 'Job closing date',
                            'content' => \Carbon\Carbon::parse($job->closingDate)->format('F d, Y'),
                        ],
                        [
                            'title' => 'Posted on',
                            'content' => \Carbon\Carbon::parse($job->created_at)->format('F d, Y'),
                        ],
                    ];
                    foreach($datagrid_items as $item) {
                        $title = $item['title'];
                        $content = $item['content'];
                        
                        echo "<div class=\"datagrid-item\">
                            <div class=\"datagrid-title\">$title</div>
                            <div class=\"datagrid-content\">$content</div>
                        </div>";
                    }
?>
                </div>
<?php
                $content = $job->description;
                if($content != '') {
                    echo "<div class=\"mt-4\">
                        <div class=\"text-primary fw-bold h3 mb-2\">Job Description</div>
                        <div>$content</div>
                    </div>";
                }

                $content = $job->responsibilities;
                if($content != '') {
                    echo "<div class=\"mt-4\">
                        <div class=\"text-primary fw-bold h3 mb-2\">Responsibilities</div>
                        <div>$content</div>
                    </div>";
                }       
                
                if(!empty($job->skills)) {
                    echo '<div class="d-block mt-4"><div class="text-primary fw-bold h3 mb-2">Skill Requirements</div>';
                    foreach(explode(',', $job->skills) as $tag) {
                        $color = in_array($tag, freelancer()->skillSet()) ? 'bg-blue' : 'badge-outline text-blue';
                        echo '<span class="badge '.$color.' px-3 me-2 mb-1" href="#">'.$tag.'</span>';
                    }
                    echo '</div>';
                }
?>
            </div>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#modal_confirmapply" <?= (\App\Models\JobApplication::isApplied(freelancer()->id, $job->id)) || !empty($errors) ? 'disabled' : '' ?>>Apply to this Job</button>
            </div>
        </div>
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
<div class="modal modal-blur fade" id="modal_confirmapply" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Apply</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to apply to this job?</p>
            </div>
            <div class="modal-footer">
                <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                <button type="submit" name="btnConfirmApply" class="btn btn-primary">Yes</button>
            </div>
        </form>
    </div>
</div>
<?php
    include('includes/freelancer_footer.php');
?>
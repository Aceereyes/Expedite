<?php
    include('includes/partner_header.php');
?>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title"><?= (isset($_GET['id'])) ? 'Freelancer' : 'Freelancers'; ?></h2>
                </div>
<?php
                if(isset($_GET['id'])) {
                    echo '<div class="col-auto ms-auto d-print-none">
                        <a href="freelancers.php" class="btn">
                            <i class="ti ti-arrow-back"></i> Back
                        </a>
                    </div>';
                }
?>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container">
<?php
            if(isset($_GET['id'])) {
                $freelancer = \App\Models\Freelancer::where('id', $_GET['id'])->first();
?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="row align-items-center justify-content-center mb-3">
                                <span class="avatar avatar-xl" style="background-image: url('<?= $freelancer->getAvatar() ?>')"></span>
                            </div>
                            <div class="h1 m-0"><?= strtoupper($freelancer->fullName()); ?></div>
                            <p class="m-0"><?= $freelancer->address(); ?></p>
                            <p class="m-0">Email Address: <?= $freelancer->email ?></p>
                            <p class="m-0">Phone Number: <?= $freelancer->phone ?></p>
                        </div>

<?php
                        if($freelancer->languageProficiencies->count() > 0) {
                            echo '<p class="mt-3 mb-2 h3 text-primary">Language Proficiency</p>';
                            $qualifications = $freelancer->languageProficiencies;
                            foreach($qualifications as $qualification) {
                                echo "<div class=\"fw-bold\">$qualification->language</div>
                                <div class=\"text-muted mb-2\">
                                    <b>Reading:</b> $qualification->reading
                                    <b>Writing:</b> $qualification->writing
                                    <b>Speaking:</b> $qualification->speaking
                                </div>";
                            }
                        }

                        if($freelancer->academicQualifications->count() > 0) {
                            echo '<p class="mt-3 mb-2 h3 text-primary">Academic Qualifications</p>';
                            $qualifications = $freelancer->academicQualifications->all();
                            foreach($qualifications as $qualification) {
                                echo "<div class=\"fw-bold\">$qualification->institution ($qualification->timeframe)</div>
                                <div class=\"text-muted mb-2\">$qualification->course ($qualification->level)</div>";
                            }
                        }

                        if($freelancer->professionalQualifications->count() > 0) {
                            echo '<p class="mt-3 mb-2 h3 text-primary">Professional Qualifications</p>';
                            $qualifications = $freelancer->professionalQualifications;
                            foreach($qualifications as $qualification) {
                                echo "<div class=\"fw-bold\">$qualification->institution ($qualification->timeframe)</div>
                                <div class=\"text-muted mb-2\">$qualification->title</div>";
                            }
                        }

                        if($freelancer->trainingAndWorkshops->count() > 0) {
                            echo '<p class="mt-3 mb-2 h3 text-primary">Trainings and Workshop Attended</p>';
                            $qualifications = $freelancer->trainingAndWorkshops;
                            foreach($qualifications as $qualification) {
                                echo "<div class=\"fw-bold\">$qualification->training ($qualification->timeframe)</div>
                                <div class=\"text-muted mb-2\">$qualification->institution</div>";
                            }
                        }

                        if($freelancer->workExperiences->count() > 0) {
                            echo '<p class="mt-3 mb-2 h3 text-primary">Work Experiences</p>';
                            $qualifications = $freelancer->workExperiences;
                            foreach($qualifications as $qualification) {
                                echo "<div class=\"fw-bold\">$qualification->institution ($qualification->job_title)</div>
                                <div class=\"text-muted\">$qualification->timeframe</div>
                                <div class=\"text-muted mb-2\">$qualification->dutiesAndResponsibilities</div>";
                            }
                        }
?>
                    </div>
                </div>
<?php
            } else {
                echo "<div class=\"row row-cards\">";
                $freelancers = \App\Models\Freelancer::all();
                foreach($freelancers as $item) {
                    $fullName = $item->fullName();
                    $avatar = $item->getAvatar();
                    $link = createUrl('freelancers.php', ['id' => $item->id]);
                    echo "<div class=\"col-md-6 col-lg-3 mb-3\">
                        <div class=\"card\">
                            <div class=\"card-body p-4 pb-2 text-center\">
                                <span class=\"avatar avatar-xl mb-3 rounded\" style=\"background-image: url($avatar)\"></span>
                                <h3 class=\"m-0 mb-1\">
                                    <a href=\"#\">$fullName</a>
                                </h3>
                                <div class=\"mt-1\">
                                    <span class=\"badge bg-purple-lt\">Freelancer</span>
                                </div>
                            </div>
                            <div class=\"d-flex\"></div>
                            <a href=\"$link\" class=\"card-btn\">Profile</a>
                        </div>
                    </div>";
                }
                echo "</div>";
            }
?>
        </div>
    </div>
<?php
    include('includes/partner_footer.php');
?>
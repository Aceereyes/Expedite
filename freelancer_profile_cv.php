<?php
    include('includes/freelancer_header.php');

    if(freelancer()->initialSetup) {
        setFlashMessage('error', 'You must update your profile initially!');
        redirect('freelancer_profile.php');
        exit();
    }
?>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="col-3 d-md-block border-end">
                        <div class="card-body">
<?php
                            include('includes/freelancer_profile_sidebar.php');
?>
                        </div>
                    </div>
                    <div class="col d-flex flex-column">
                        <div class="card-body pb-4">
                            <div class="row g-2 align-items-center mb-3">
                                <div class="col-auto ms-auto d-print-none">
                                    <a href="javascript:window.print();" class="btn">
                                        <i class="ti ti-printer"></i> Print
                                    </a>
                                </div>
                            </div>


                            <!-- CV Start -->
                            <div class="h1 m-0"><?= strtoupper(freelancer()->fullName()); ?></div>
                            <p class="m-0"><?= freelancer()->address();?></p>
                            <p class="m-0">Email Address: <?= freelancer()->email ?></p>
                            <p class="m-0">Phone Number: <?= freelancer()->phone ?></p>

<?php
                            if(freelancer()->languageProficiencies->count() > 0) {
                                echo '<p class="mt-3 mb-2 h3 text-primary">Language Proficiency</p>';
                                $qualifications = freelancer()->languageProficiencies;
                                foreach($qualifications as $qualification) {
                                    echo "<div class=\"fw-bold\">$qualification->language</div>
                                    <div class=\"text-muted mb-2\">
                                        <b>Reading:</b> $qualification->reading
                                        <b>Writing:</b> $qualification->writing
                                        <b>Speaking:</b> $qualification->speaking
                                    </div>";
                                }
                            }

                            if(freelancer()->academicQualifications->count() > 0) {
                                echo '<p class="mt-3 mb-2 h3 text-primary">Academic Qualifications</p>';
                                $qualifications = freelancer()->academicQualifications->all();
                                foreach($qualifications as $qualification) {
                                    echo "<div class=\"fw-bold\">$qualification->institution ($qualification->timeframe)</div>
                                    <div class=\"text-muted mb-2\">$qualification->course ($qualification->level)</div>";
                                }
                            }

                            if(freelancer()->professionalQualifications->count() > 0) {
                                echo '<p class="mt-3 mb-2 h3 text-primary">Professional Qualifications</p>';
                                $qualifications = freelancer()->professionalQualifications;
                                foreach($qualifications as $qualification) {
                                    echo "<div class=\"fw-bold\">$qualification->institution ($qualification->timeframe)</div>
                                    <div class=\"text-muted mb-2\">$qualification->title</div>";
                                }
                            }

                            if(freelancer()->trainingAndWorkshops->count() > 0) {
                                echo '<p class="mt-3 mb-2 h3 text-primary">Trainings and Workshop Attended</p>';
                                $qualifications = freelancer()->trainingAndWorkshops;
                                foreach($qualifications as $qualification) {
                                    echo "<div class=\"fw-bold\">$qualification->training ($qualification->timeframe)</div>
                                    <div class=\"text-muted mb-2\">$qualification->institution</div>";
                                }
                            }

                            if(freelancer()->workExperiences->count() > 0) {
                                echo '<p class="mt-3 mb-2 h3 text-primary">Work Experiences</p>';
                                $qualifications = freelancer()->workExperiences;
                                foreach($qualifications as $qualification) {
                                    echo "<div class=\"fw-bold\">$qualification->institution ($qualification->job_title)</div>
                                    <div class=\"text-muted\">$qualification->timeframe</div>
                                    <div class=\"text-muted mb-2\">$qualification->dutiesAndResponsibilities</div>";
                                }
                            }
?>
                            <!-- CV End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include('includes/freelancer_footer.php');
?>

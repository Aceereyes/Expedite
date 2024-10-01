<?php
    include('includes/partner_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Record does not exist!');
        redirect('partner_job_applicants.php');
        exit();
    }
    $application = \App\Models\JobApplication::find($_GET['id']);
    $freelancer = $application->freelancer;
    $job = $application->job;
    $textarea_readonly = 'false';
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    Applicant
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-sm-inline">
                        <a href="<?= base_url("partner_job_applicants.php?id=$job->id"); ?>" class="btn"><i class="ti ti-arrow-back"></i> Back</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- CV Start -->
                <div class="h1 m-0"><?= strtoupper($freelancer->fullName()); ?></div>
                <p class="m-0"><?= $freelancer->address() ?></p>
                <p class="m-0">Email Address: <?= $freelancer->email ?></p>
                <p class="m-0">Phone Number: <?= $freelancer->phone ?></p>

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
        <!-- CV End -->

<?php
            $schedule = \App\Models\InterviewSchedule::where('job_application_id', $_GET['id'])
                ->orderBy('created_at', 'desc')
                ->first();
            if($schedule !== null) {

                if(isset($_POST['btnAccept'])) {
                    $mail = new \App\Mailer\Mailer();
                    $mail->AddAddress($freelancer->email);
                    $mail->isHTML(true);
                    $mail->Subject = "Job Order Notification";
                    $mail->Body = '<p>Hello there!</p>
                        <p>Your application has been accepted.</p>
                        <p>- '.$application->partner->name.'</p>
                    ';
                    try {
                        $mail->send();
                        $schedule->createJobOrder();
                        $schedule->application->update(['status' => 'Accepted']);
                        $schedule->job->update(['active' => false]);
                        
                        setFlashMessage('success', 'Application accepted successfully!');
                        refresh();
                        exit();
                    } catch(\Exception $e) {
                        setFlashMessage('error', 'Failed to send email. Something went wrong.');
                    }
                    refresh();
                    exit();
                }
                else if(isset($_POST['btnReschedule'])) {
                    $start = $_POST['start'];
                    $end = $_POST['end'];
                    $note = $_POST['note'];

                    $mail = new \App\Mailer\Mailer();
                    $mail->AddAddress($freelancer->email);
                    $mail->isHTML(true);
                    $mail->Subject = "Interview ReSchedule Notification";
                    $mail->Body = '<p>Hello there!</p>
                        <p>You\'re interview schedule was moved on to'.\Carbon\Carbon::parse($start)->format('F d, Y h:iA').' to '.\Carbon\Carbon::parse($end)->format('F d, Y h:iA').'</p>
                        <p>We are hoping to see you!</p>
                        <p>- '.$application->partner->name.'</p>
                    ';
                    try {
                        $mail->send();
                        $schedule->update([
                            'start' => \Carbon\Carbon::parse($_POST['start'])->format('Y-m-d H:i:s'),
                            'end' => \Carbon\Carbon::parse($_POST['end'])->format('Y-m-d H:i:s')
                        ]);
                        setFlashMessage('success', 'Application rescheduled successfully!');
                        refresh();
                        exit();
                    } catch(\Exception $e) {
                        setFlashMessage('error', 'Failed to send email. Something went wrong.');
                    }
                    refresh();
                    exit();
                }
                else if(isset($_POST['btnDecline'])) {
                    $mail = new \App\Mailer\Mailer();
                    $mail->AddAddress($freelancer->email);
                    $mail->isHTML(true);
                    $mail->Subject = "Job Order Notification";
                    $mail->Body = '<p>Hello there!</p>
                        <p>Your application has been declined.</p>
                        <p>- '.$application->partner->name.'</p>
                    ';

                    try {
                        $mail->send();
                        $schedule->application->update(['status' => 'Declined']);
                        setFlashMessage('success', 'Application declined successfully!');
                        refresh();
                        exit();
                    } catch(\Exception $e) {
                        setFlashMessage('error', 'Failed to send email. Something went wrong.');
                    }
                    refresh();
                    exit();
                }
                $input_flag = $schedule->application->isPending() ? 'required' : 'disabled';
                $textarea_readonly = !$schedule->application->isPending() ? 'true' : 'false';
?>
                <form method="POST" class="card mt-3">
                    <div class="card-header">
                        Interview Schedule
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Start</label>
                                    <input type="datetime-local" value="<?= \Carbon\Carbon::parse($schedule->start)->format('Y-m-d\TH:i:s') ?>" name="start" class="form-control" <?= $input_flag; ?>>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">End</label>
                                    <input type="datetime-local" value="<?= \Carbon\Carbon::parse($schedule->end)->addHour()->format('Y-m-d\TH:i:s') ?>" name="end" class="form-control" <?= $input_flag; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note</label>
                            <textarea name="note" class="tinyMCE"><?= $schedule->note ?></textarea>
                        </div>
                    </div>
<?php
                    if($schedule->application->isPending()) {
                        echo '<div class="card-footer text-center">
                            <button type="submit" name="btnAccept" class="btn btn-success px-5 mx-3 my-3">Accept</button>
                            <button type="submit" name="btnReschedule" class="btn btn-primary px-5 mx-3 my-3">Update</button>
                            <button type="submit" name="btnDecline" class="btn btn-danger px-5 mx-3 my-3">Decline</button>
                        </div>';
                    } else {
                        $alert_color = $schedule->application->status === 'Accepted' ? 'success' : 'danger';
                        echo "<div class=\"card-footer text-center m-0\">
                            <div class=\"alert alert-$alert_color m-0\">The application has been ".strtolower($schedule->application->status)."</div>
                        </div>";
                    }
?>
                </form>
<?php
            } else {
?>
<?php
                if(isset($_POST['btnAddSchedule'])) {
                    \App\Models\InterviewSchedule::create([
                        'partner_id' => partner()->id,
                        'freelancer_id' => $freelancer->id,
                        'job_id' => $application->job->id,
                        'job_application_id' => $application->id,
                        'start' => $_POST['start'],
                        'end' => $_POST['end'],
                        'note' => $_POST['note']
                    ]);
                    setFlashMessage('success', 'Interview Scheduled!');
                    refresh();
                    exit();
                }
?>
                <form class="card my-3" method="POST">
                    <div class="card-header">
                        Schedule an Interview
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Start</label>
                                    <input type="datetime-local" value="<?= \Carbon\Carbon::now()->format('Y-m-d\TH:00') ?>" name="start" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">End</label>
                                    <input type="datetime-local" value="<?= \Carbon\Carbon::now()->addHour()->format('Y-m-d\TH:00') ?>" name="end" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note</label>
                            <textarea name="note" class="tinyMCE"></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" name="btnAddSchedule" class="btn btn-primary px-5">Add Schedule</button>
                    </div>
                </form>
<?php
                }
?>
        </div>
    </div>
</div>
<script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        let options = {
            selector: '.tinyMCE',
            height: 200,
            menubar: 'insert | format',
            promotion: false,
            statusbar: false,
            plugins: 'image',
            readonly: <?= $textarea_readonly; ?>,
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
        }
        if (localStorage.getItem("tablerTheme") === 'dark') {
            options.skin = 'oxide-dark';
            options.content_css = 'dark';
        }
        tinyMCE.init(options);
    });
</script>
<?php
    include('includes/partner_footer.php');
?>
<?php
    include('includes/partner_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Job does not exist!');
        redirect('partner_jobs.php');
        exit();
    }
    $job_order = \App\Models\JobOrder::find($_GET['id']);
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    Job Order
                </h2>
                <div class="page-subtitle">
                    <?= $job_order->job->title; ?> (<?= $job_order->job->category; ?>)<br/>
                    Freelancer: <b><?= $job_order->freelancer->fullName() ?></b>
                </div>
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
        if($job_order->submitted_at != null) {
?>
            <div class="row">
                <div class="col-sm-9">
                    <form method="POST" class="card mb-3">
                        <div class="card-body">
                            <div class="h3 mb-3">Instructions</div>
                            <div class="mb-3">
                                <?= $job_order->job->instructions ?? '<div class="alert alert-info">There are no instructions available at the moment</div>'; ?>
                            </div>

                            <div class="h3 mb-3">Submission</div>
                            <div class="mb-3">
                                <?= $job_order->composed ?? '<div class="alert alert-info">Freelancer doesn\'t have a submission yet.</div>'; ?>
                            </div>

                            <div class="h3 mb-3">Attachments</div>
<?php
                                $attachments = $job_order->attachments;
                                if($attachments->count() > 0) {
                                    foreach($attachments as $attachment) {
                                        echo '<div class="input-group mb-3">
                                            <input type="text" value="'.$attachment->file_name.'" class="form-control" disabled>
                                            <a class="btn btn-outline-secondary" href="uploads/'.$attachment->file_name.'" target="_blank">Preview</a>
                                        </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-info">There are no attachments available at the moment.</div>';
                                }
?>
                        </div>

<?php
                        if($job_order->isPending()) {
?>
                            <div class="card-footer text-center">
                                <div class="card">
                                    <div class="card-body">
                                        <p>By clicking the accept button, You agree that expedite will charge you an additional of <b><?= \App\Interfaces\Globals::EXPEDITE_CHARGE_RAW ?>%</b> of the total amount.</p>
                                        <p>You will be charged an additional of <b>PHP <?= number_format($job_order->getCharge(), 2); ?></b></p>
                                        <p>Total: <b>PHP <?= number_format($job_order->getTotalWithCharge(), 2) ?></b></p>
                                    </div>
                                </div>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal_acceptSubmission" name="btnAccept" class="btn btn-success px-5 mx-3 my-3">Accept Submission</button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal_rejectSubmission" name="btnReject" class="btn btn-danger px-5 mx-3 my-3">Reject Submission</button>
                            </div>
<?php
                        } else {
                            $alert_color = $job_order->status == \App\Models\JobOrder::ACCEPTED ? 'success' : 'danger';
                            echo "<div class=\"card-footer text-center m-0\">
                                <div class=\"alert alert-$alert_color m-0\">The job order submission has been ".strtolower($job_order->status)."</div>
                            </div>";
                        }
?>
                        
                    </form>

<?php
                    if($job_order->isPending()) {
                        if(isset($_POST['btnAccept'])) {
                            \App\Models\FRM\Receivable::create([
                                'freelancer_id' => $job_order->freelancer->id,
                                'partner_id' => $job_order->partner->id,
                                'job_order_id' => $job_order->id,
                                'amount' => $job_order->getCharge(),
                                'description' => 'Charge with job order: PHP '.$job_order->getCharge().'',
                            ]);
                            \App\Models\Freelancer\Receivable::create([
                                'freelancer_id' => $job_order->freelancer->id,
                                'partner_id' => $job_order->partner->id,
                                'job_order_id' => $job_order->id,
                                'amount' => $job_order->getTotal(),
                                'description' => 'Received from Job order: PHP '.$job_order->getTotal().'',
                            ]);
                            \App\Models\Partner\Payable::create([
                                'freelancer_id' => $job_order->freelancer->id,
                                'partner_id' => $job_order->partner->id,
                                'job_order_id' => $job_order->id,
                                'amount' => $job_order->getTotalWithCharge(),
                                'description' => 'Payment for Job order: PHP '.$job_order->getTotalWithCharge().'',
                            ]);

                            $job_order->update([
                                'status' => \App\Models\JobOrder::ACCEPTED,
                                'reason' => null
                            ]);
                            setFlashMessage('success', 'Job order submission has been accepted!');
                            refresh();
                            exit();
                        }
                        else if(isset($_POST['btnDecline'])) {
                            $job_order->update([
                                'status' => \App\Models\JobOrder::DECLINED,
                                'reason' => $_POST['reason'],
                                'submitted_at' => null,
                            ]);
                            setFlashMessage('success', 'Job order submission has been declined!');
                            refresh();
                            exit();
                        }
?>
                        <!-- Accept Submission -->
                        <div class="modal modal-blur fade" id="modal_acceptSubmission" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="POST" class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Accept Submission</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to accept this submission?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                                        <button type="submit" name="btnAccept" class="btn btn-success">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Decline Submission -->
                        <div class="modal modal-blur fade" id="modal_rejectSubmission" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="POST" class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Decline Submission</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to decline this submission? Please state your reason.</p>
                                        <div class="mb-3">
                                            <textarea name="reason" class="tinyMCE"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                                        <button type="submit" name="btnDecline" class="btn btn-danger">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
<?php
                    }
?>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="h3 mb-3">Information</div>
                            <div class="datagrid">
<?php
                                $datagrid_items = [
                                    [ 'title' => 'Deadline', 'content' => $job_order->getDeadline() ],
                                    [ 'title' => 'Submitted on', 'content' => $job_order->submissionDateTime() ],
                                    [ 'title' => 'Status', 'content' => $job_order->status ],
                                    [ 'title' => 'Amount', 'content' => 'PHP '.number_format($job_order->job->amount, 2) ],
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
                        </div>
                    </div>
                </div>
            </div>
            <script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
            <script>
                $(document).ready(function () {
                    let options = {
                        selector: '.tinyMCE',
                        height: 200,
                        menubar: 'format',
                        promotion: false,
                        statusbar: false,
                        readonly: false,
                        toolbar: 'undo redo | formatselect | ' +
                            'bold italic backcolor | alignleft aligncenter ' +
                            'alignright alignjustify | bullist numlist outdent indent | ' +
                            'removeformat',
                        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }',
                    }
                    if (localStorage.getItem("tablerTheme") === 'dark') {
                        options.skin = 'oxide-dark';
                        options.content_css = 'dark';
                    }
                    tinyMCE.init(options);
                });
            </script>
<?php
        } else {
?>
            <div class="alert alert-info">There are no submissions available at the moment.</div>
<?php
        }
?>
    </div>
</div>
<?php
    include('includes/partner_footer.php');
?>
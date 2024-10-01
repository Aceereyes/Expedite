<?php
    include('includes/freelancer_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Record does not exist!');
        redirect('freelancer_job_orders.php');
        exit();
    }

    $job_order = \App\Models\JobOrder::find($_GET['id']);

    function uploadFiles() {
        global $job_order;

        $total = count($_FILES['files']['name']);
        for($i = 0; $i < $total; $i++) {
            $tmpFilePath = $_FILES['files']['tmp_name'][$i];
            if ($tmpFilePath != ""){
                $file_name = uniqid().'.'.pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
                $newFilePath = "uploads/".$file_name;
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    \App\Models\JobOrderAttachment::create([
                        'job_order_id' => $job_order->id,
                        'file_name' => $file_name
                    ]);
                }
            }
        }
    }

    //Delete Attachment
    if(isset($_POST['btnConfirmDeleteAttachment'])) {
        $attachment_id = $_POST['attachment_id'];
        $delete = \App\Models\JobOrderAttachment::where('id', $attachment_id)->delete();

        setFlashMessage('success', 'Attachment Deleted');
        refresh();
        exit();
    }

    //Save JO
    if(isset($_POST['btnSave'])) { 
        uploadFiles();       
        $job_order->update([
            'composed' => $_POST['composer'],
        ]);
        setFlashMessage('success', 'Saved!');
        refresh();
        exit();
    }
    //Submit JO
    else if(isset($_POST['btnSubmit'])) {
        uploadFiles();       
        $job_order->update([
            'composed' => $_POST['composer'],
            'status' => 'Pending',
            'submitted_at' => date('Y-m-d H:i:s'),
        ]);
        setFlashMessage('success', 'Submitted!');
        refresh();
        exit();
    }
?>
    <div class="page-body">
        <div class="container">
<?php
            if($job_order->isDeclined()) {
                $message = 'Your submission has been declined.';
                if((!empty($job_order->reason) || $job_order->reason != null)) {
                    $message = '
                        <p class="fw-bold">Your submission has been declined due to the following reason(s):</p>
                        '.$job_order->reason.'
                    ';
                }
                echo '<div class="alert alert-danger">
                    '.$message.'
                </div>';
            }
?>
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">Job Order</h2>
                    <div class="page-subtitle">
                        <?= $job_order->job->title; ?> (<?= $job_order->job->category; ?>)<br/>
                        Partner: <b><?= $job_order->partner->name ?></b>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <a href="freelancer_job_orders.php" class="btn">
                        <i class="ti ti-arrow-back"></i> Back
                    </a>
                </div>
            </div>
            <div class="row">
<?php
                if($job_order->submitted_at == null) {
?>
                    <form method="POST" class="col-sm-9" enctype="multipart/form-data">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="h3 mb-3">Instructions</div>
                                <div class="mb-3">
                                    <?= $job_order->job->instructions ?? ''; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-label">Compose</div>
                                <textarea name="composer" id="composer"><?= $job_order->composed ?? ''; ?></textarea>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="card-title">Attachments</h3>
<?php
                                $attachments = $job_order->attachments;
                                foreach($attachments as $attachment) {
                                    echo '<div class="input-group mb-3">
                                        <input type="text" value="'.$attachment->file_name.'" class="form-control" disabled>
                                        <a class="btn btn-outline-secondary" href="uploads/'.$attachment->file_name.'" target="_blank">Preview</a>
                                        <button type="button" onclick="confirmDelete(\''.$attachment->id.'\', \''.$attachment->file_name.'\');" class="btn btn-outline-danger">Delete</button>
                                    </div>';
                                }
?>
                                <input name="files[]" class="form-control" type="file" multiple="multiple"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="btnSave" class="btn btn px-5 mt-3 mx-4 mb-3">Save</button>
                            <button type="submit" name="btnSubmit" class="btn btn-primary px-5 mt-3 mx-4 mb-3">Submit</button>
                        </div>
                    </form>
                    
                    <!-- Delete the record -->
                    <div class="modal modal-blur fade" id="modal_confirmdelete" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form method="POST" class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="attachment_id" id="attachment_id">
                                    <p>Are you sure you want to delete attachment named: <b id="attachment_name"></b>?</p>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                                    <button type="submit" name="btnConfirmDeleteAttachment" class="btn btn-danger">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        function confirmDelete(id, name) {
                            $('#attachment_id').val(id);
                            $('#attachment_name').text(name);
                            new bootstrap.Modal(document.getElementById('modal_confirmdelete')).show();
                        }
                    </script>

<?php
                } else {
?>
                    <div class="col-sm-9">
<?php
                        if($job_order->status == \App\Models\JobOrder::ACCEPTED) {
                            echo "<div class=\"alert alert-success\">Job order has already been accepted.</div>";
                        } else {
                            echo "<div class=\"alert alert-info\">Job order has already been submitted.</div>";
                        }
?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="h3 mb-3">Instructions</div>
                                <div class="mb-3">
                                    <?= $job_order->job->instructions ?? '<div class="alert alert-info">There are no instructions available at the moment</div>'; ?>
                                </div>
                                
                                <div class="h3 mb-3">Submission</div>
                                <div class="mb-3">
                                    <?= $job_order->composed ?? ''; ?>
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
                                        echo '<div class="alert alert-info">There are no attachments uploaded.</div>';
                                    }
?>
                                <div class="text-center">
<?php
                                    if(!$job_order->isAccepted()) {
                                        echo '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_confirmedit" class="btn btn-primary px-5 mt-3 mx-4 mb-3">Edit</a>';
                                    }
?>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
                    if(isset($_POST['btnConfirmEdit'])) {
                        $job_order->update([
                            'submitted_at' => null,
                        ]);
                        refresh();
                        exit();
                    }
?>
                    <!-- Delete the record -->
                    <div class="modal modal-blur fade" id="modal_confirmedit" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form method="POST" class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="attachment_id" id="attachment_id">
                                    <p>Are you sure you want to edit the job order?</p>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                                    <button type="submit" name="btnConfirmEdit" class="btn btn-primary">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
<?php
                }
?>

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
        </div>
    </div>
    <script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
    <script>
        $(document).ready(function () {
            $('.form-select').each((key, element)=> {
                new TomSelect(element);
            });
            let options = {
                selector: '#composer',
                height: 300,
                menubar: 'insert | format',
                promotion: false,
                statusbar: false,
                readonly: false,
                plugins: 'image',
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
    include('includes/freelancer_footer.php');
?>
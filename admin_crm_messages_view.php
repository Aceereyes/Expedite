<?php
    include('includes/admin_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Message does not exist!');
        redirect('admin_crm_messages.php');
        exit();
    }
    
    $message = \App\Models\CRM\Message::find($_GET['id']);
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Message
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_crm_messages.php" class="btn">
                            <i class="ti ti-arrow-back"></i> Back
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
<?php
        if(isset($_POST['btnSendEmail'])) {
            $subject = $_POST['subject'];
            $content = $_POST['content'];

            $mail = new \App\Mailer\Mailer();
            $mail->AddAddress($message->email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $content;

            try {
                $mail->send();
                $message->update([
                    'done' => true
                ]);
                setFlashMessage('success', 'Message has been replied successfully!');
                redirect('admin_crm_messages.php');
                exit();
            } catch(\Exception $e) {
                setFlashMessage('error', 'Failed to send email. Something went wrong.');
            }
            refresh();
            exit();
        }
?>
        <form method="POST" class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <div class="form-label">Name</div>
                            <input type="text" value="<?= $message->name; ?>" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <div class="form-label">Email Address</div>
                            <input type="text" value="<?= $message->email; ?>" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Subject</div>
                    <input type="text" name="subject" value="RE: <?= $message->subject; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <textarea name="content">
                        <p>Regarding this message: </p>
                        <blockquote>
                            <?= $message->message; ?>
                        </blockquote>
                        <br/>
                        <p><b>This is the reply to your message: </b></p>
                        <p></p>
                    </textarea>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" name="btnSendEmail" class="btn btn-primary px-5">Send Email</button>
            </div>
        </form>
    </div>
</div>
<script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
<script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('.form-select').each((key, element)=> {
            new TomSelect(element);
        });
        let options = {
            selector: 'textarea',
            height: 600,
            menubar: 'edit | format | insert',
            promotion: false,
            statusbar: false,
            readonly: false,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace fullscreen media table',
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
    include('includes/admin_footer.php');
?>
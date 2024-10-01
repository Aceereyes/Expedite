<?php
    include('includes/guest_header.php');

    if(isset($_POST['btnSendMessage'])) {
        $validator = new App\Validation\Factory;
        $validation = $validator->validate($_POST, [
            'name:Name'                               => 'required',
            'email:Email'                              => 'required',
            'subject:Subject'                                => 'required',
            'message:Message'                                => 'required',
        ]);
        if($validation->fails()) {
            setFlashMessage('error', 'Submission Error',
                [ 'html' => sprintf("'%s'", implode('<br/>', $validation->errors()->all())) ],
                [ 'timer' => '6000' ]
            );
            refresh();
        } else {
            \App\Models\CRM\Message::create([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
            ]);
            setFlashMessage('success', 'Message has been sent successfully. Please wait for an Email.');
            refresh();
            exit();
        }
        exit();
    
        
    }
?>


<div class="page-body">
    <div class="container">
        <div class="page-title mb-3">
            Contact us
        </div>
    </div>
    <div class="container">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="w-100 h-100">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="message" name="message" required> </textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="btnSendMessage" class="btn btn-primary px-5">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="<?= images('earn_more.png'); ?>" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
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
            height: 200,
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
    include('includes/guest_footer.php');
?>
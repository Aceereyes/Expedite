<?php
    include('includes/freelancer_header.php');
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
                    <div method="POST" class="col d-flex flex-column" enctype="multipart/form-data">
                        <div class="card-body pb-4">
                            <div class="row g-2 align-items-center mb-3">
                                <div class="col">
                                    <h2 class="page-title">Other Attachments</h2>
                                </div>
                                <div class="col-auto ms-auto d-print-none">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal_add" class="btn">
                                        <i class="ti ti-plus"></i> Add
                                    </a>
                                </div>
                            </div>
<?php
                            $attachments = \App\Models\Freelancer\OtherAttachment::where('freelancer_id', freelancer()->id)->get();
                            if($attachments->count() > 0) {
                                foreach($attachments as $attachment) {
?>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="fw-bold"><?= $attachment->type; ?></div>
                                                    <div class="text-muted"><?= $attachment->issuer; ?></div>
                                                </div>
                                                <div class="col-auto ms-auto d-print-none">
                                                    <div class="btn-list">
                                                        <a href="<?= base_url('freelancer_profile_other_edit.php?id='.$attachment->id); ?>" class="btn btn-primary d-sm-inline-block">
                                                            Edit
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
<?php
                                }
                            } else {
                                echo '<div class="alert alert-info">There are no records to display.</div>';
                            }
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to Add Record -->
<?php
    if(isset($_POST['btnAdd'])) {
        $storage = new \Upload\Storage\FileSystem('uploads');
        $file = new \Upload\File('attachment', $storage);
        $file->setName(uniqid());
        
        try {
            $file->upload();
            $academicQualification = \App\Models\Freelancer\OtherAttachment::create([
                'freelancer_id' => freelancer()->id,
                'type' => $_POST['type'],
                'issuer' => $_POST['issuer'],
                'name' => $file->getNameWithExtension(),
            ]);
            setFlashMessage('success', 'Attachment has been successfully.');
        } catch (\Exception $e) {
            setFlashMessage('success', 'File Upload Error');
        }
        refresh();
        exit();
    }
?>
    <div class="modal modal-blur fade" id="modal_add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add Attachments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Attachment Type</label>
                        <input type="text" class="form-control" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Issuer</label>
                        <input type="text" class="form-control" name="issuer" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Attachment</label>
                        <input type="file" class="form-control" name="attachment" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
                    <button type="submit" name="btnAdd" class="btn btn-primary">Submit</button>
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
                selector: '#dutiesAndResponsibilities',
                height: 200,
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
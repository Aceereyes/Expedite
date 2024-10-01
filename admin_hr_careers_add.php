<?php
    include('includes/admin_header.php');

    if(isset($_POST['btnCreate'])) {
        $career = new \App\Models\HR\Career();
        $career->title = $_POST['title'];
        $career->description = $_POST['description'];
        $career->save();

        setFlashMessage('success', 'Career has been created!');
        redirect('admin_hr_careers.php');
        exit();
    }
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Add Careers
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_hr_careers.php" class="btn">
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
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="mb-3 form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label class="form-label">Description</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>
                    <div class="mt-3 mb-3 text-center">
                        <button type="submit" name="btnCreate" class="btn btn-primary px-5">Create Career</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        let options = {
            selector: '#description',
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
    include('includes/admin_footer.php');
?>
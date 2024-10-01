<?php
    include('includes/admin_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Career does not exist!');
        redirect('admin_hr_careers.php');
        exit();
    }
    
    $employee = \App\Models\HR\Career::find($_GET['id']);

    if(isset($_POST['btnUpdate'])) {
        $employee->update([
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ]);
        setFlashMessage('success', 'Career has been updated successfully!');
        refresh();
        exit();
    }
    else if(isset($_POST['btnConfirmDelete'])) {
        $employee->delete();
        setFlashMessage('success', 'Career has been deleted successfully!');
        redirect('admin_hr_careers.php');
        exit(); 
    }
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Edit Career
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
                        <input type="text" name="title" value="<?= $employee->title ?>" class="form-control" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label class="form-label">Description</label>
                        <textarea id="description" name="description" required><?= $employee->description ?></textarea>
                    </div>
                    <div class="mt-3 mb-3 text-center">
                        <button type="submit" name="btnUpdate" class="btn btn-primary px-5">Update Career</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_confirmdelete" class="btn btn-danger px-5 mx-4">Delete Career</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal_confirmdelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this account?</p>
            </div>
            <div class="modal-footer">
                <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                <button type="submit" name="btnConfirmDelete" class="btn btn-danger">Yes</button>
            </div>
        </form>
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
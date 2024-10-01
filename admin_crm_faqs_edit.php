<?php
    include('includes/admin_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'FAQ does not exist!');
        redirect('admin_crm_faqs.php');
        exit();
    }
    
    $faq = \App\Models\CRM\FAQ::find($_GET['id']);

    if(isset($_POST['btnUpdate'])) {
        $faq->update([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'active' => $_POST['active'],
        ]);
        setFlashMessage('success', 'FAQ has been updated successfully!');
        redirect('admin_crm_faqs.php');
        exit();
    }
    else if(isset($_POST['btnConfirmDelete'])) {
        $faq->delete();
        setFlashMessage('success', 'FAQ has been deleted successfully!');
        redirect('admin_crm_faqs.php');
        exit(); 
    }
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Frequently Asked Questions
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_crm_faqs.php" class="btn">
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
        if(isset($_POST['btnAddFAQ'])) {
            \App\Models\CRM\FAQ::create([
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'active' => $_POST['active'],
            ]);
            setFlashMessage('success', 'FAQ added successfully');
            redirect('admin_crm_faqs.php');
            exit();
        }
?>
        <form method="POST" class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="mb-3">
                            <div class="form-label">Title</div>
                            <input type="text" name="title" value="<?= $faq->title ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <div class="form-label">Active?</div>
                            <select name="active" class="form-control form-select" required>
<?php
                                foreach(['No', 'Yes'] as $key => $value) {
                                    $selected = ($faq->active == $key) ? 'selected' : '';
                                    echo "<option value=\"$key\" $selected>$value</option>";
                                }
?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <textarea name="content"><?= $faq->content ?></textarea>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" name="btnUpdate" class="btn btn-primary px-5">Update FAQ</button>
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
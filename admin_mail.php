<?php
    include('includes/admin_header.php');
?>

<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Message
                </h2>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
        <form method="POST" class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="mb-3">
                            <div class="form-label">Subject</div>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <div class="form-label">Recipients</div>
                            <select name="sendTo" class="form-control form-select" required>
<?php   
                                foreach(['Human Resources - Internal', 'Human Resources - External', 'Marketing and Advertising','Accounting and Finance'] as $value) {
                                    echo "<option value=\"$value\">$value</option>";
                                }
?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <textarea name="content"></textarea>
                </div>

                <div class=mb-3>
                    <div class="form-label">Attachments</div>
                </div>

<!-- HTML -->
<div class="mb-3">
    <input type="file" id="attachments" name="attachments" multiple onchange="displaySelectedFiles(event)">
    <div id="selectedFiles"></div>
</div>

<script>
    function displaySelectedFiles(event) {
        var fileInput = event.target;
        var selectedFilesDiv = document.getElementById('selectedFiles');
        selectedFilesDiv.innerHTML = ""; // Clear existing content

        for (var i = 0; i < fileInput.files.length; i++) {
            var file = fileInput.files[i];
            var fileInfo = document.createElement('span');
            fileInfo.innerHTML = file.name + " (" + formatBytes(file.size) + ") ";
            var deleteButton = document.createElement('button');
            deleteButton.innerHTML = "x";
            deleteButton.onclick = (function(file) {
                return function() {
                    // Remove the specific file from the input
                    var newFiles = Array.from(fileInput.files).filter(function(f) {
                        return f !== file;
                    });
                    var newFileInput = new DataTransfer();
                    newFiles.forEach(function(f) {
                        newFileInput.items.add(f);
                    });
                    fileInput.files = newFileInput.files;
                    displaySelectedFiles(event);
                };
            })(file);
            fileInfo.appendChild(deleteButton);
            selectedFilesDiv.appendChild(fileInfo);
            selectedFilesDiv.appendChild(document.createElement('br'));
        }
    }

    function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
</script>
                
            </div>
            <div class="card-footer text-center">
                <button type="submit" name="btnSendEmail" class="btn btn-primary px-5">Send Message</button>
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
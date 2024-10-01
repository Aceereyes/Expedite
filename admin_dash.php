<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Dashboard
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
<?php
        if(isset($_POST['btnSubmit'])) {
            $validator = new App\Validation\Factory;
            $validation = $validator->make($_POST, [
                'email:Email' => 'required|exists:admins,email',
            ]);
            $validation->validate();
    
            if($validation->fails()) {
                setFlashMessage('error', 'Error',
                    [ 'html' => sprintf("'%s'", implode('<br/>', $validation->errors()->all())) ],
                    [ 'timer' => '6000' ]
                );
            } else {
                setFlashMessage('success', 'FAQ added successfully');
            }
            refresh();
            exit();
        }
?>
        <form method="POST">
            <div class="mb-3">
                <input type="text" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" name="btnSubmit" class="btn">Submit</button>
            </div>
        </form>

    </div>
</div>
<?php
    include('includes/admin_footer.php');
?>
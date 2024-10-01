<?php
    include('includes/admin_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Account does not exist!');
        redirect('admin_accounts.php');
        exit();
    }
    
    $admin = \App\Models\Admin::find($_GET['id']);

    if(isset($_POST['btnUpdate'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $department = $_POST['department']; 

        $errors = [];
        
        $admin_email = \App\Models\Admin::where('email', '=', $email);
        $hr_email = \App\Models\HR\Employee::where('email', '=', $email);

        if($admin_email->exists() || $hr_email->exists())
            $errors[] = 'Email already exists!';

        if(count($errors) > 0) {
            setFlashMessage('error', implode(', ', $errors));
            refresh();
            exit();
        } else {
            $admin->update([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'department' => $department
            ]);
            setFlashMessage('success', 'Admin account has been updated successfully!');
            redirect('admin_accounts.php');
            exit();
        }
    }
    else if(isset($_POST['btnConfirmDelete'])) {
        $admin->delete();
        setFlashMessage('success', 'Admin account has been deleted successfully!');
        redirect('admin_accounts.php');
        exit(); 
    }
    else if(isset($_POST['btnResetPassword'])) {
        $newPassword = md5('123456789');
        $admin->update([
            'password' => $newPassword
        ]);
        setFlashMessage('success', 'Password has been reset successfully!');
        refresh();
        exit();
    }
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Edit Account
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_accounts.php" class="btn">
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" name="firstName" value="<?= $admin->firstName; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lastName" value="<?= $admin->lastName; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 form-group">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="<?= $admin->email; ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-3 text-center">
                        <button type="submit" name="btnUpdate" class="btn btn-primary px-5 mx-4">Update Account</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_resetPassword" class="btn btn-warning px-5 mx-4">Reset Password</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_confirmdelete" class="btn btn-danger px-5 mx-4">Delete Account</button>
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
<div class="modal modal-blur fade" id="modal_resetPassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reset this account's password?</p>
            </div>
            <div class="modal-footer">
                <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                <button type="submit" name="btnResetPassword" class="btn btn-warning">Yes</button>
            </div>
        </form>
    </div>
</div>
<script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
<script>
    $(document).ready(function () {
        $('.form-select').each((key, element)=> {
            new TomSelect(element);
        });;
    });
</script>
<?php
    include('includes/admin_footer.php');
?>
<?php
    if(isset($_POST['btnChangePassword'])) {
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $password_confirmation = md5($_POST['confirm_new_password']);

        $errors = [];
        if($old_password != admin()->password)
            $errors[] = 'Incorrect old password!';

        if($new_password != $password_confirmation)
            $errors[] = 'Password confirmation does not match!';
        
        if(count($errors) > 0) {
            setFlashMessage('error',  implode(', ', $errors) );
            refresh();
            exit();
        } else {
            $adminId = admin()->id;
            admin()->update([
                'password' => $new_password
            ]);
            unset($_SESSION['admin']);
            setFlashMessage('success', 'Password has been changed successfully!');
            redirect('index.php');
            exit();
        }
    }
?>
<div class="modal modal-blur fade" id="modal_cpass" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="old_password" class="form-control">
                </div>
                <div class="mb-3 form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control">
                </div>
                <div class="mb-3 form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="confirm_new_password" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</a>
                <button type="submit" name="btnChangePassword" class="btn btn-primary">Change Password</button>
            </div>
        </form>
    </div>
</div>
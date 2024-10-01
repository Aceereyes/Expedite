<?php
    include('includes/freelancer_header.php');

    if(isset($_POST['btnSubmit'])) {
        $errors = [];

        if(md5($_POST['old_password']) != freelancer()->password) {
            $errors[] = "Incorrect old password!";
        }
        if($_POST['new_password'] != $_POST['password_confirmation']) {
            $errors[] = "Password confirmation does not match!";
        }

        if(empty($errors)) {
            freelancer()->update([
                'password' => md5($_POST['new_password'])
            ]);
            setFlashMessage('success', 'Change Password success! You will be logged out after 2 seconds');
            redirect('logout.php', 2);

        } else {
            setFlashMessage('error', implode(",", $errors));
            refresh();
            exit();
        }
    }
?>
<div class="page-body">
    <div class="container-tight">
        <form method="POST" class="card" autocomplete="off">
            <div class="card-body">
                <h2 class="mb-4">Change Password</h2>
                <div class="mb-3">
                    <label class="form-label required">Old Password</label>
                    <input type="password" name="old_password" class="form-control" placeholder="Old Password">
                </div>
                <div class="mb-3">
                    <label class="form-label required">New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="New Password">
                </div>
                <div class="mb-3">
                    <label class="form-label required">New Password Confirmation</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="New Password confirmation" autocomplete="new-password">
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" name="btnSubmit" class="btn btn-primary px-5">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php
    include('includes/freelancer_footer.php');
?>
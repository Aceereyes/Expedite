x`<?php
    include('includes/admin_header.php');

    if (isset($_POST['btnCreate'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = md5($_POST['password'], PASSWORD_DEFAULT);
    
        $validator = new App\Validation\Factory;
        $validation = $validator->validate($_POST, [
            'firstName:First Name'                             => 'required|alpha_spaces',
            'lastName:Last Name'                               => 'required|alpha_spaces',
            'email:Email Address'                              => 'required|email|unique:partners,email',
            'password:Password'                                => 'required',
            'confirm_password:Confirm Password'                => 'required|same:password,Password',
        ]);



        $admin_email = \App\Models\Admin::where('email', '=', $email);
        $hr_email = \App\Models\HR\Employee::where('email', '=', $email);
        

        if($admin_email->exists() || $hr_email->exists())
            setFlashMessage('error', implode(', ', $errors));

        if(count($errors) > 0) {
            setFlashMessage('error', implode(', ', $errors));
            refresh();
            exit();
    
        if ($validation->fails()) {
            setFlashMessage('error', 'Registration Error',
                ['html' => sprintf("'%s'", implode('<br/>', $validation->errors()->all()))],
                ['timer' => '6000']
            );
            refresh();
        } else {
            \App\Models\Admin::create([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'password' => $password,
            ]);
            setFlashMessage('success', 'Admin account has been added successfully!');
            redirect('admin_accounts.php');
        }
        exit();
    }
}
    
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Add Account
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
                                <input type="text" name="firstName" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lastName" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="mb-3 form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- Start -->
                        <div class="col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                <input type="password" name="password" class="form-control" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Requirements: At least 8 characters, One lowercase, One Uppercase, One number, One special character">
                                    <button class="input-group-text toggle-password" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4"></path>
                                            <path d="M3 15l2.5 -3.8"></path>
                                            <path d="M21 14.976l-2.492 -3.776"></path>
                                            <path d="M9 17l.5 -4"></path>
                                            <path d="M15 17l-.5 -4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <script>
                            const passwordInput = document.querySelector('input[name="password"]');
                            const togglePasswordButton = document.querySelector('.toggle-password');

                            togglePasswordButton.addEventListener('click', function() {
                                if (passwordInput.type === 'password') {
                                    passwordInput.type = 'text';
                                    togglePasswordButton.innerHTML = `
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                        </svg>`;
                                } else {
                                    passwordInput.type = 'password';
                                    togglePasswordButton.innerHTML = `
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4"></path>
                                        <path d="M3 15l2.5 -3.8"></path>
                                        <path d="M21 14.976l-2.492 -3.776"></path>
                                        <path d="M9 17l.5 -4"></path>
                                        <path d="M15 17l-.5 -4"></path>
                                    </svg>`;
                                }
                            });
                        </script>


                        <!-- End -->

                        <!-- Start -->
                        <div class="col-sm-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Requirements: At least 8 characters, One lowercase, One Uppercase, One number, One special character">
                                    <button class="input-group-text toggle-confirm-password" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4"></path>
                                            <path d="M3 15l2.5 -3.8"></path>
                                            <path d="M21 14.976l-2.492 -3.776"></path>
                                            <path d="M9 17l.5 -4"></path>
                                            <path d="M15 17l-.5 -4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <script>
                            const confirmPassInput = document.querySelector('input[name="confirm_password"]');
                            const toggleConfirmPassButton = document.querySelector('.toggle-confirm-password');

                            toggleConfirmPassButton.addEventListener('click', function() {
                                if (confirmPassInput.type === 'password') {
                                    confirmPassInput.type = 'text';
                                    toggleConfirmPassButton.innerHTML = `
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                        </svg>`;
                                } else {
                                    confirmPassInput.type = 'password';
                                    toggleConfirmPassButton.innerHTML = `
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4"></path>
                                            <path d="M3 15l2.5 -3.8"></path>
                                            <path d="M21 14.976l-2.492 -3.776"></path>
                                            <path d="M9 17l.5 -4"></path>
                                            <path d="M15 17l-.5 -4"></path>
                                        </svg>`;
                                }
                            });
                        </script>

                        <!-- End -->
                    </div>
                    <div class="mt-3 mb-3 text-center">
                        <button type="submit" name="btnCreate" class="btn btn-primary px-5">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
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
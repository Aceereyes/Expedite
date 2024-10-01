<?php
    include('includes/guest_header.php');


    if(isset($_POST['btnRegister'])) {
        $validator = new App\Validation\Factory;
        $validation = $validator->validate($_POST, [
            'name:Partner Name'                                 => 'required',
            'type:Partner Type'                                 => 'required|alpha_spaces',
            'email:Email Address'                               => 'required|email|unique:partners,email',
            'password:Password'                                 => 'required',
            'password_confirmation:Password Confirmation'       => 'required|same:password,Password',
        ]);
        if($validation->fails()) {
            setFlashMessage('error', 'Registration Error',
                [ 'html' => sprintf("'%s'", implode('<br/>', $validation->errors()->all())) ],
                [ 'timer' => '6000' ]
            );
            refresh();
        } else {
            $freelancer = \App\Models\Partner::create([
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'email' => $_POST['email'],
                'password' => md5($_POST['password'])
            ]);
            setFlashMessage('success', 'Registration success!');
            redirect('login_partner.php');
        }
        exit();
    }
?>
    <div class="page page-center" style="background-image: url(assets/images/bglogin6.png); background-size: cover; background-repeat: no-repeat; background-position: center center;">
        <div class="container container-tight py-4">
            <div class="card card-md" style="border-radius: 70px;">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Become One Of Our Partners</h2>
                    <form method="POST" autocomplete="off">
                        <div class="mb-3">
                            <label class="form-label">Partner Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Your Name" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Partner Type</label>
                            <select class="form-select" name="type" required>
<?php
                                foreach(config('app.partner.skills') as $types => $skills) {
                                    echo "<option value=\"$types\">$types</option>";
                                }
?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email Address" autocomplete="off" required>
                        </div>

                        <!-- Start -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Enter Your Password" autocomplete="off" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Requirements: At least 8 characters, One lowercase, One Uppercase, One number, One special character" id="password" required>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="
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
                            <div class="mb-3">
                                <div class="row">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Your Password" autocomplete="off" id="confirm_password" required>
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
                                const confirmPassInput = document.querySelector('input[name="password_confirmation"]');
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

                        <div class="mb-3 mt-4">
                            <label class ="form-check-label"> 
                                <input type="checkbox" class="form-check-input" required>
                                    <span>
                                    I agree to the
                                    <a href="terms.php" tabindex="-1">Terms and Conditions</a>
                                    and
                                    <a href="privacy_policy.php" tabindex="-1">Privacy Policy</a>.
                                    </span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" name="btnRegister" class="btn btn-primary w-100 rounded-pill" style="background-color: #00BFFF; font-size: 16px; padding: 12px;">Register</button>
                        </div>
                    </form>
                </div>
                    <div class="hr-text">or</div>
                        <div class="card-body">
                            <a href="register_freelancer.php" class="btn btn-outline-secondary w-100 rounded-pill btn-cute" style="font-size: 16px; padding: 12px;">Register as Freelancer</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
    <script>
        $(document).ready(function () {
            $('.form-select').each((key, element)=> {
                new TomSelect(element);
            });
        });
    </script>
<?php
    include('includes/guest_footer.php');
?>
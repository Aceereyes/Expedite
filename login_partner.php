<?php
    include('includes/guest_header.php');

    if(isset($_POST['btnSignin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $partner = \App\Models\Partner::where('email', $email)->first();

        if($partner !== null)  {
            if(md5($password) == $partner->password) {
                $_SESSION['partner'] = $partner;
                redirect('partner_dashboard.php');
                exit();
            } else {
                setFlashMessage('error', 'Login details incorrect!');
            }
        } else {
            setFlashMessage('error', 'Partner not found');
        }
        refresh();
        exit();
    }
?>
    <div class="page page-center" style="background-image: url(assets/images/bglogin7.png); background-size: cover; background-repeat: no-repeat; background-position: center center;">
        <div class="container container-tight py-4">
            <div class="card card-md" style="border-radius: 70px;">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Partner Login</h2>
                    <form method="POST" autocomplete="off" novalidate="">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email Address" autocomplete="off">
                        </div>
                        <!-- Start -->
                        <div class="mb-2">
                            <label class="form-label">Password</label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control" placeholder="Enter Your Password" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4"></path>
                                            <path d="M3 15l2.5 -3.8"></path>
                                            <path d="M21 14.976l-2.492 -3.776"></path>
                                            <path d="M9 17l.5 -4"></path>
                                            <path d="M15 17l-.5 -4"></path>
                                        </svg>
                                    </span>
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

                        <div class="form-footer">
                            <button type="submit" name="btnSignin" class="btn btn-primary w-100 rounded-pill" style="background-color: #00BFFF; font-size: 16px; padding: 12px;">Sign in</button>
                        </div>
                    </form>
                </div>
                <div class="hr-text">or</div>
                <div class="card-body">
                    <a href="login_freelancer.php" class="btn btn-outline-secondary w-100 rounded-pill btn-cute" style="font-size: 16px; padding: 12px;">Freelancer Login</a>
                </div>
            </div>
            <div class="text-center text-muted mt-3">
                Don't have account yet? <a href="<?= base_url('register_partner.php'); ?>" tabindex="-1">Sign up</a>
            </div>
        </div>
    </div>
<?php
    include('includes/guest_footer.php');
?>
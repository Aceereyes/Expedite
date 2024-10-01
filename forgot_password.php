<?php
    include('includes/guest_header.php');
    use \App\Validation\Rules\Equal;

    if(isset($_GET['r'])) {
        $reset_password = \App\Models\UserReset::where('token', '=', $_GET['r'])->first();
        if($reset_password !== null) {
            if(isset($_POST['btnReset'])) {

                $validator = new App\Validation\Factory;
                $validation = $validator->make($_POST, [
                        'new_password' => 'required|min:8',
                        'new_password_confirmation' => 'required|min:8|same:new_password',
                        'email' => [ 'required', Equal::make($reset_password->email)],
                        'studentNumber' => ['required', Equal::make($reset_password->studentNumber)]
                    ])
                    ->setAlias('new_password', 'New Password')
                    ->setAlias('new_password_confirmation', 'New Password Confirmation')
                    ->setAlias('email', 'Email Address')
                    ->setAlias('studentNumber', 'Student Number');
                $validation->validate();

                if($validation->fails()) {
                    setFlashMessage('error', 'Password Reset Error', [ 'html' => sprintf("'%s'", implode('<br/>', $validation->errors()->all())) ], ['timer' => '6000']);
                    refresh();
                    exit();
                } else {
                    $password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
                    \App\Models\User::where('email', '=', $reset_password->email)->update([
                        'password' => $password
                    ]);
                    \App\Models\UserReset::where('token', '=', $reset_password->token)->delete();
                    setFlashMessage('success', 'Password has been resetted successfully!');
                    redirect('login');
                    exit();
                }
            }
?>
            <div class="container-tight">
                <form class="card card-md" method="post" autocomplete="off">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Reset Password</h2>
                        <p class="text-muted mb-4">Enter your email address, and new password to further validate your account.</p>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" value="" class="form-control" placeholder="Enter Email" required autofocus tabindex="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" value="" class="form-control" placeholder="Enter New Password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" value="" class="form-control" placeholder="Enter Confirm New Password" required>
                        </div>
                        <div class="form-footer">
                            <button type="submit" name="btnReset" class="btn btn-primary w-100" tabindex="4">Reset my Password</button>
                        </div>
                    </div>
                </form>
            </div>
<?php
        } else {
            setFlashMessage('error', 'Invalid Reset Password Link!');
            redirect('login');
            exit();
        }
    } else {
        if(isset($_POST['btnReset'])) {
            $email = $_POST['email'];
    
            $user = \App\Models\User::where('email', '=', $email)->first();
            if($user !== null) {            
                $emailToken = \App\Models\UserReset::where('email', '=', $email)->first();

                if($emailToken !== null) {
                    setFlashMessage('error', 'Email already sent. Check your email.');
                } else {    
                    $token = encrypt(encrypt($user->email.date('Y-m-d H:i:s')));
                    $reset_link = base_url('forgot_password_admin?r='.$token);
    
                    $mail = new \App\Mailer\Mailer();
                    $mail->IsHTML(true);
                    $mail->AddAddress($email);
                    $mail->Subject = 'Reset Password | '.config('app.web_title');
                    $mail->Body = password_reset_email($reset_link, images('logo.png'));
    
                    if($mail->Send()) {
                        \App\Models\UserReset::create([
                            'email' => $email,
                            'token' => $token
                        ]);
                        setFlashMessage('success', 'Check your email and click on the Reset Password link.');
                        redirect('login');
                        exit();
                    } else {
                        setFlashMessage('error', $mail->ErrorInfo);
                    }
                }
            } else {
                setFlashMessage('error', 'User does not exist!');
            }
            refresh();
            exit();
        }
?>
        <div class="container-tight">
            <form class="card card-md" method="post" autocomplete="off">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Forgot Password</h2>
                    <p class="text-muted mb-4">Enter your email address and your password will be reset and emailed to you.</p>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="" class="form-control" placeholder="Enter Email" required autofocus tabindex="1">
                    </div>
                    <div class="form-footer">
                        <button type="submit" name="btnReset" class="btn btn-primary w-100" tabindex="4">Reset my Password</button>
                    </div>
                </div>
                <div class="card-footer text-center bg-primary">
                    <a href="login" class="text-white">Sign in as Student Assistant</a>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                Already have account? <a href="login_admin" tabindex="-1">Sign in</a>
            </div>
        </div>
<?php
    }
    include('includes/guest_footer.php');
?>
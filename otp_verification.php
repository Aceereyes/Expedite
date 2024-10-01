<?php
include('includes/guest_header.php');
session_start();

if(isset($_POST['btnVerify'])) {
    $otpCode = $_POST['otpCode'];
    
    if(isset($_SESSION['otpCode']) && $_SESSION['otpCode'] == $otpCode) {
        // OTP code is correct, proceed with login or any other action
        // Clear the OTP code from session
        unset($_SESSION['otpCode']);
        
        // Redirect to the desired page
        redirect('login_freelancer.php');
        exit();
    } else {
        setFlashMessage('error', 'Invalid OTP code');
        redirect('otp_verification.php');
        exit();
    }
}

function redirect($url) {
    header('Location: ' . $url);
    exit();
}

function setFlashMessage($type, $message) {
    $_SESSION['flashMessage'] = array(
        'type' => $type,
        'message' => $message
    );
}

function getFlashMessage() {
    if(isset($_SESSION['flashMessage'])) {
        $flashMessage = $_SESSION['flashMessage'];
        unset($_SESSION['flashMessage']);
        return $flashMessage;
    }
    return null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body>
    <h1>OTP Verification</h1>
    
    <?php
    $flashMessage = getFlashMessage();
    if($flashMessage !== null) {
        echo '<div class="' . $flashMessage['type'] . '">' . $flashMessage['message'] . '</div>';
    }
    ?>
    
    <form action="otpverification.php" method="post">
        <label for="otpCode">Enter OTP code:</label>
        <input type="text" id="otpCode" name="otpCode" required>
        <button type="submit" name="btnVerify">Verify</button>
    </form>
</body>
</html>
<?php
    include('includes/guest_footer.php');
?>
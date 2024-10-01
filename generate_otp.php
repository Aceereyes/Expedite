<?php
use App\Mailer\Mailer;

require 'vendor/autoload.php';

// Generate a random 6-digit OTP code
$otpCode = rand(100000, 999999);

// Create a PHPMailer instance
$mail = new Mailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your@example.com';
    $mail->Password = 'your_password';
    $mail->SMTPSecure = Mailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('from@example.com', 'Your Name');
    $email = $_POST['email'];
    $mail->addAddress($email, 'Recipient Name');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your OTP Code';
    $mail->Body    = 'Your OTP code is: ' . $otpCode;

    $mail->send();
    echo 'OTP code sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Set the expiration of the OTP code to 5 minutes
$otpExpiration = time() + (5 * 60); // 5 minutes

// Save the OTP code and its expiration time in the database
// ...

// Create a sample email template for the code
$emailTemplate = '<p>Your OTP code is: ' . $otpCode . '</p>'; // You can customize the email template as per your design

// Save the email template in a file or database for future use
// ...
?>
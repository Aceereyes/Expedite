<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailerAutoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

						$name = $_POST['name'];
						$email = $_POST['email'];
						$subject = $_POST['subject'];
						$message = $_POST['message'];
						$date = $_POST['date'];
						
						
						
						$reply_name = ''.$name.'';
						$contactinformation_email = $_POST['contactinformation_email'];
						$reply_subject = 'REPLY - '.$subject.'';
						$reply_message = $_POST['reply_message'];
						$reply_date = date("F d, Y - h:i A");
try {
    //Server settings
	$mail->SMTPDebug = 0;
    $mail->isSMTP();
	$mail->Host  = "mail.mameceaafw.com";
    $mail->SMTPAuth   = true;
	$mail->Username   = "jms@mameceaafw.com";
	$mail->Password   = "vo=WD+XxDt";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('jms@mameceaafw.com', ''.$reply_name.'');
	$mail->addAddress(''.$email.'', ''.$name.'');
    $mail->addReplyTo(''.$email.'', ''.$reply_name.'');
	
    //Content
    $mail->isHTML(true);
    $mail->Subject = ''.$reply_subject.'';
    $mail->Body    .= '
	<b>'.$name.',</b>
	<br>
	<br>
	'.$reply_message.'
	
	<br><br><br><br>
	If there\'s anything else we can do to assist, please do not hesitate to let us know.
	<br>
	Email back us at <b>'.$contactinformation_email.'</b>.
	<br>
	<br>
	Thank you,
	<br><br><br><br><br><br>
	On '.$date.' '.$name.' <'.$email.'> wrote:
	<br>
	<br>
	'.$message.'';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
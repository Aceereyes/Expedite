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
    $mail->setFrom('jms@mameceaafw.com', 'JMS Newsletter');
	$mail->addAddress(''.$email.'');
    $mail->addReplyTo('jms@mameceaafw.com', 'Do Not Reply');
	
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'JMS Newsletter - Subscribe';
    $mail->Body    .= '
	<b>'.$email.' Thank you for joining us!</b>
	<br>
	<br>
	We\'ll keep you posted on the lastest updates and news about us.
	<br>
	Stay connected.
	<br><br>
	If you\'d like to unsubscribed, click <a href = "https://jms.mameceaafw.com/unsubscribe.php?email='.$email.'">here</a>
	<br>
	<br>
	<br>
	<br>
	<h2><b>JMS</b> Jerico Mark</h2>
	<b>Trading & General Services<br></b>
	Electronic | Electrical | Ref & Aircon<br>
	M.H Del Pilar St. San Vicente I Silang, Cavite<br>
	(0927) 606 6912 | (046) 487 3694 | jms.jericomarktrading@gmail.com';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
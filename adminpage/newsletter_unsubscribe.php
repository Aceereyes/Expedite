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
    $mail->Subject = 'JMS Newsletter - Unsubscribe';
    $mail->Body    .= '
	<h1>YOU WILL BE MISSED</h1>
	Your email address <b>'.$email.'</b> will no longer receive anymore emails from <b>jms@mameceaafw.com</b>.
	<br>
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
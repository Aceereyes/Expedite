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
    $mail->setFrom('jms@mameceaafw.com', 'JMS INQUIRY');
	$mail->addAddress(''.$user_email_requester.'', ''.$fullname.'');
	
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'JMS '.$type_of_service.' service.';
    $mail->Body    = '
	<b>'.$fullname.'</b>,
	<br>
	<br>
	<b>'.$fullname_approver.'</b> update your status on '.$type_of_service.'
	<br>
	Your item <b>'.$item.'</b> to be <b>'.$type_of_service.'</b> is now '.$iCheckstatus.'.
	<br>
	<br>
	<h2>ITEM DETAILS</h2>
	Type Of Service: '.$item.'
	<br>
	Description: '.$description.'
	<br>
	ITEM NAME: '.$item.'
	<br>
	DATE & TIME of REQUEST: '.$date.' - '.$time.'
	<br>
	<h2>ITEM DETAILS</h2>
	REMARKS: '.$remarks.'
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
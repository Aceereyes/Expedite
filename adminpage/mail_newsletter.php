<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
	$mail->setFrom('jms@mameceaafw.com', 'JMS NEWSLETTER');
	//$mail->addAddress(''.$email.'');
	
	$subscribe_email=mysqli_query($conn, "SELECT * FROM subscribe");
	while($subscribe_email_show=mysqli_fetch_array($subscribe_email))
	{
	$mail->AddCC(''.$subscribe_email_show['email'].'');
	//Content
	$mail->isHTML(true);
	$mail->Subject = 'JMS NEWSLETTER';
	$mail->AddEmbeddedImage('_photos/newsletter/'.$photo_msg.'', 'logo_2u');
	$mail->Body    = '<b>Good Day,</b>
	<br>
	<br>
	'.$message.'
	<br>
	<br>
	<br>
	<br>
	<h2><b>JMS</b> Jerico Mark</h2>
	<b>Trading & General Services<br></b>
	Electronic | Electrical | Ref & Aircon<br>
	M.H Del Pilar St. San Vicente I Silang, Cavite<br>
	(0927) 606 6912 | (046) 487 3694 | jms.jericomarktrading@gmail.com';
	}
	$mail->send();
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	/*
	<br><br><br><br><br><br><br><br><br>
	Click to <a href = "mameceaafw.com?eidail='.$subscribe_email_show['id'].'" target = "_blank">unsubscribe</a> MAMECEA-AFW newsletter.*/
?>
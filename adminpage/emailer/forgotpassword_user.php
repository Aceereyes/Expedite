<?php
require 'email_sender/PHPMailer/src/Exception.php';
require 'email_sender/PHPMailer/src/PHPMailer.php';
require 'email_sender/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'email_sender/PHPMailer/PHPMailerAutoload.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
	$mail->SMTPDebug = 0;
    $mail->isSMTP();
	$mail->Host  = "mail.mameceaafw.com";
    $mail->SMTPAuth   = true;
	$mail->Username   = "zoomaster@mameceaafw.com";
	$mail->Password   = "V8%{P1d$?MgM";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('zoomaster@mameceaafw.com', 'DLSMHSI');
	$mail->addAddress(''.$user_email.'', ''.$user_firstname.' '.$user_middlename.' '.$user_lastname.'');
	
	//Content
	//$mail->addReplyTo('1@dlshsi.edu.ph', ''.$colleges_department_code.'');
	$mail->isHTML(true);
	$mail->Subject = 'DLSMHSI ONLINE FORMS | FORGOT PASSWORD';
	
	
	$mail->Body   .= '<h2><b>Account Information</b></h2>';
	//$mail->AddEmbeddedImage('_photos/profilephotos/admins/'.$ADMIN_firstname.''.$ADMIN_middlename.''.$ADMIN_lastname.'/'.$user_staff_photo.'', 'logo_2u');
	$mail->Body   .= '
	<li> <b>Userame:</b> '.$user_username.'</li>
	<li> <b>Password:</b> '.$user_password.'</li>
	Click <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"><i>here</i></a> to Login.';
    $mail->send();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
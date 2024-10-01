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
	$mail->Username   = "jms@mameceaafw.com";
	$mail->Password   = "vo=WD+XxDt";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('jms@mameceaafw.com', 'ACCOUNT REGISTRATION');
	$mail->addAddress(''.$user_staff_email.'', ''.$user_staff_first_name.' '.$user_staff_middle_name.' '.$user_staff_last_name.'');
	
	//Content
	//$mail->addReplyTo('1@dlshsi.edu.ph', ''.$colleges_department_code.'');
	$mail->isHTML(true);
	$mail->Subject = 'JMS | ACCOUNT CREATION';
	
	
	$mail->Body   .= '<h2><b>User\'s Information</b></h2>';
	$mail->AddEmbeddedImage('_photos/profilephotos/admins/'.$user_staff_first_name.''.$user_staff_middle_name.''.$user_staff_last_name.'/'.$user_staff_photo.'', 'logo_2u');
	$mail->Body   .= '
	<li> <b>Fullname:</b> '.$user_staff_first_name.' '.$user_staff_middle_name.' '.$user_staff_last_name.'</li>
	<li> <b>Contact No:</b> '.$user_staff_contact.'</li>
	<li> <b>Email:</b> '.$user_staff_email.'</li>
	<li> <b>Userame:</b> '.$user_staff_username.'</li>
	<li> <b>Password:</b> '.$user_staff_password.'</li>
	<li> <b>Account Priviledge:</b> '.$priviledge_level.'</li>
	<li> <b>Account Registration Date:</b> '.$new_date_sent_converted.'</li>
	Click <a href = "https://jms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"><i>here</i></a> to Login.';
	
    $mail->send();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
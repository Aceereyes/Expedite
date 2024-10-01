<?php
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
	$mail->addAddress(''.$user_email.'', ''.$fullname.'');     //Add a recipient
	$mail->isHTML(true);                                  		// Set email format to HTML
	$mail->Subject = 'DLSMHSI ONLINE FORMS | FORM SENT';
	$mail->Body   .= '<p><b>'.$fullname.'</b>,<br/>You have successfully sent form <b>'.$file_description.'</b> attach below.</p>';
	$mail->Body   .= '<h2><b>Form Information</b></h2>';
	$mail->Body   .= '
	<ul>
	<li> <b>Form:</b> <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location.'/'.$file_name.'" class="btn btn-success btn-xs"> '.$file_name.' <i>(click here to view)</i></a></li>
	<li> <b>Form Attached:</b> <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location_attachment.'/'.$files_attachment_name.'" class="btn btn-success btn-xs"> '.$files_attachment_name.' <i>(click here to view)</i></a></li>
	<li> <b>Form Name:</b> '.$file_description.'</li>
	<li> <b>Email:</b> '.$email.'</li>
	<li> <b>Date Sent:</b> '.$new_date_sent_convert.'</li>
	<li> <b>Time Sent:</b> '.$new_time_sent_convert.'</li>
	<li> <b>Department Name:</b> '.$department.' - '.$department_name.'</li>
	</ul>
	<br/> '.$email_signature.'
	<br/>
	<br/>
	Already a member ? <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"> Login</a>';
	
	$mail->send();	
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
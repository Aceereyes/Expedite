<?php

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
	$mail->Username   = "zoomaster@mameceaafw.com";
	$mail->Password   = "V8%{P1d$?MgM";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
	
	$mail->Subject = 'DLSMHSI ONLINE FORMS | FORM SIGNATORY';
	$mail->setFrom('zoomaster@mameceaafw.com', 'DLSMHSI');
	$mail->isHTML(true);
	$mail->Body   .= '<p><b>'.$user_firstname.' '.$user_lastname.'</b>, <br/><b>'.$fullname_created.'</b> of <b>'.$collegesdepartment_code.' - '.$collegedepartment_name.'</b> as <b>'.$ADMIN_PRIVILEDGE_LEVEL.'</b> has been successfully added you as interdepartment signatory.</p>';
	$mail->addAddress(''.$user_email.'', ''.$user_firstname.' '.$user_lastname.'');
	$mail->Body   .= '
	<br/>
	<br/>
	Already a member ? <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"> Login</a>';
	$mail->send();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
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
	
	$mail->setFrom('zoomaster@mameceaafw.com', 'DLSMHSI');
	
    $department_adminuser_admin = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_dept = '$user_dept' && user_priviledge_level = 'Admin'");
	while($department_adminuser_view_admin=mysqli_fetch_array($department_adminuser_admin))
	{
		$user_email_view_admin = ''.$department_adminuser_view_admin['user_email'].'';
		$user_fullname_view_admin = ''.$department_adminuser_view_admin['user_firstname'].' '.$department_adminuser_view_admin['user_lastname'].'';
		$mail->AddCC(''.$user_email_view_admin.'', ''.$user_fullname_view_admin.'');
	}
	
	$department_adminuser_moderator = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_dept = '$user_dept' && user_priviledge_level = 'Moderator'");
	while($department_adminuser_view_moderator=mysqli_fetch_array($department_adminuser_moderator))
	{
	$user_email_view_moderator = ''.$department_adminuser_view_moderator['user_email'].'';
	$user_fullname_view_moderator = ''.$department_adminuser_view_moderator['user_firstname'].' '.$department_adminuser_view_moderator['user_lastname'].'';
	$mail->AddCC(''.$user_email_view_moderator.'', ''.$user_fullname_view_moderator.'');
	}
	
	$mail->isHTML(true);
	$mail->Subject = 'DLSMHSI ONLINE FORMS | FORM SIGNATORY';
	$mail->Body   .= '<p><b>'.$collegesdepartment_code.'</b> Admins/Moderators, <b>'.$user_firstname.' '.$user_lastname.'</b>, has been successfully added as signatory by <b>'.$fullname_created.'</b> of <b>'.$collegesdepartment_code.' - '.$collegedepartment_name.'</b> as <b>'.$ADMIN_PRIVILEDGE_LEVEL.'</b>.</p>';

	$mail->Body   .= '
	<br/>
	<br/>
	Already a member ? <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"> Login</a>';
			
	$mail->send();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
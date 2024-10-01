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

    //Recipients
    $mail->setFrom('zoomaster@mameceaafw.com', 'DLSMHSI');
	
			$department_user = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE colleges_department_code = '$department'");
			$department_user_show = mysqli_fetch_array($department_user);
			$colleges_department_id = $department_user_show['id'];
			$colleges_department_name1 = $department_user_show['colleges_department_name'];
			$colleges_department_code_signatory = $department_user_show['colleges_department_code'];
			
    $department_adminuser_admin = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_dept = '$colleges_department_id' && user_priviledge_level = 'Admin' && user_notification = 'ON'");
	while($department_adminuser_view_admin=mysqli_fetch_array($department_adminuser_admin))
	{
		$user_email_view_admin = ''.$department_adminuser_view_admin['user_email'].'';
		$user_fullname_view_admin = ''.$department_adminuser_view_admin['user_firstname'].' '.$department_adminuser_view_admin['user_lastname'].'';
		$mail->AddCC(''.$user_email_view_admin.'', ''.$user_fullname_view_admin.'');
	}
	
	$department_adminuser_moderator = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_dept = '$colleges_department_id' && user_priviledge_level = 'Moderator' && user_notification = 'ON'");
	while($department_adminuser_view_moderator=mysqli_fetch_array($department_adminuser_moderator))
	{
	$user_email_view_moderator = ''.$department_adminuser_view_moderator['user_email'].'';
	$user_fullname_view_moderator = ''.$department_adminuser_view_moderator['user_firstname'].' '.$department_adminuser_view_moderator['user_lastname'].'';
	$mail->AddCC(''.$user_email_view_moderator.'', ''.$user_fullname_view_moderator.'');
	}
	
    //Content
	$mail->isHTML(true);
	$mail->Subject = 'DLSMHSI ONLINE FORMS | FORM SENT ADMIN / MODERATOR';
	
	$mail->Body   .= '<p><b>'.$department.'</b> Admins/Moderators,<b><br/>'.$fullname.'</b>, has been successfully sent form to be approved <b>'.$file_description.'</b> at <b>'.$department.'</b> attach below.</p>';
	$mail->Body   .= '<h2><b>Form Information</b></h2>';
	$mail->Body   .= '
	<ul>
	<li> <b>Form:</b> <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location.'/'.$file_name.'" class="btn btn-success btn-xs"> '.$file_name.' <i>(click here to view)</i></a></li>
	<li> <b>Form Name:</b> '.$file_description.'</li>
	<li> <b>Email:</b> '.$email.'</li>
	<li> <b>Sent By:</b> '.$fullname.'</li>
	<li> <b>Date & Time Sent:</b> '.$new_date_sent_convert.' | '.$new_time_sent_convert.'</li>
	<li> <b>Department Name:</b> '.$department.' - '.$department_name.'</li>
	</ul>
	<br/> '.$email_signature.'
	<br/>
	<br/>
	Check status? <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"> Login</a>';
	
    $mail->send();
} catch (Exception $e) {
   //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
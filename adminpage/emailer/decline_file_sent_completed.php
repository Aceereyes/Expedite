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
	
	$department_user = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE colleges_department_code = '$dept_code'");
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
	$mail->Subject = 'DLSMHSI ONLINE FORMS | DECLINED';
	
	$sel_user = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_id'"); 
	$sel_user_display = mysqli_fetch_assoc($sel_user); 
	$user_firstname_file_sender = $sel_user_display['user_firstname'];
	$user_middlename_file_sender = $sel_user_display['user_middlename'];
	$user_lastname_file_sender = $sel_user_display['user_lastname'];
	$user_dept_file_sender = $sel_user_display['user_dept'];
	$user_priviledge_level_file_sender = $sel_user_display['user_priviledge_level'];
	
	$department_user_file_sender = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE id = '$user_dept_file_sender'");
	$department_user_file_sender_show = mysqli_fetch_array($department_user_file_sender);
	$colleges_department_name_file_sender = $department_user_file_sender_show['colleges_department_name'];
	$colleges_department_code_file_sender = $department_user_file_sender_show['colleges_department_code'];
	
	$signatory_name_approved = 'The form submitted by <b>'.$user_firstname_file_sender.' '.$user_middlename_file_sender.' '.$user_lastname_file_sender.'</b> of <b>'.$colleges_department_code_file_sender.'</b> - <b>'.$user_priviledge_level_file_sender.'</b> has been successfully decline by <b>'.$ADMIN_FIRSTNAME.' '.$ADMIN_MIDDLENAME.' '.$ADMIN_LASTNAME.'</b> of <b>'.$colleges_department_code.'</b>.';
	
	$mail->Body   .= ''.$signatory_name_approved.'<br/><br/>';
	$mail->Body   .= '<b>Reason of Decline:</b> '.$decline_reason.'';
	
	
	$file_uploads_signatory = mysqli_query($conn, "SELECT * FROM signatory_level WHERE file_id = '$file_id'");
	while($file_uploads_signatoryt_view = mysqli_fetch_array($file_uploads_signatory)){
		$user_signatory = ''.$file_uploads_signatoryt_view['user_signatory'].'';
		$user_signatory_level = ''.$file_uploads_signatoryt_view['user_signatory_level'].'';
		$select_user_signatory = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_signatory'");
		$select_user_signatory_view1=mysqli_fetch_array($select_user_signatory);
		$user_department = $select_user_signatory_view1['user_dept'];
		
	$department_user_signatory_stats = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE id = '$user_department'");
	$department_user_signatory_stats_show = mysqli_fetch_array($department_user_signatory_stats);
	$colleges_department_name_signatory_stats = $department_user_signatory_stats_show['colleges_department_name'];
	$colleges_department_code_signatory_stats = $department_user_signatory_stats_show['colleges_department_code'];
	
	$signatory_name1 = ''.$colleges_department_code_signatory_stats.' - '.$select_user_signatory_view1['user_firstname'].' '.$select_user_signatory_view1['user_lastname'].' - (APPROVED) <a href = "mameceaafw.com/form/user.php?cieti_user_id='.$select_user_signatory_view1['random_code'].'" target = "_blank">view info</a><br/>';
	$mail->Body   .= ''.$signatory_name1.'';
	}
	
	$mail->Body   .= '<h2><b>Form Sent Information</b></h2>';
	$mail->Body   .= '
	<ul>
	<li> <b>Form:</b> Click <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location.'/'.$file_name.'" class="btn btn-success btn-xs"> '.$file_name.' <i>(click here to view)</i></a></li>';
	if($attachment!= ''){
	$mail->Body   .= '
	<li> <b>Form Attachment:</b> Click <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location_attachment.'/'.$attachment.'" class="btn btn-success btn-xs"> '.$attachment.' <i>(click here to view)</i></a></li>';
	}
	$mail->Body   .= '
	<li> <b>Form Name:</b> '.$file_description.'</li>
	<li> <b>Email:</b> '.$email.'</li>
	<li> <b>Sent By:</b> '.$fullname.'</li>
	<li> <b>Date & Time Sent:</b> '.$new_date_sent_converted.' | '.$new_time_download_converted.'</li>
	<li> <b>Department Name:</b> '.$dept_code.' - '.$dept_name.'</li>';
	$mail->Body   .= '
	</li></ul>
	</ul>
	<br/>
	<br/>
	Check form status ? <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"> Login</a>';
	
    $mail->send();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
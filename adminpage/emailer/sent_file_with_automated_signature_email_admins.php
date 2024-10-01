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
	//$mail->addReplyTo(''.$department.'@dlshsi.edu.ph', ''.$file_department_code.'');
	
			$department_user = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE id = '$department_id'");
			$department_user_show = mysqli_fetch_array($department_user);
			$colleges_department_id = $department_user_show['id'];
			$colleges_department_name1 = $department_user_show['colleges_department_name'];
			$colleges_department_code_signatory = $department_user_show['colleges_department_code'];
			
    $department_adminuser_admin = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_dept = '$colleges_department_id' && user_priviledge_level = 'Admin' && user_notification = 'ON'");
	while($department_adminuser_view_admin=mysqli_fetch_array($department_adminuser_admin))
	{
	$user_email = ''.$department_adminuser_view_admin['user_email'].'';
	$user_fullname = ''.$department_adminuser_view_admin['user_firstname'].' '.$department_adminuser_view_admin['user_lastname'].'<br/>';
	$mail->AddCC(''.$user_email.'', ''.$user_fullname.'');
	}
	
	$department_adminuser_moderator = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_dept = '$colleges_department_id' && user_priviledge_level = 'Moderator' && user_notification = 'ON'");
	while($department_adminuser_view_moderator=mysqli_fetch_array($department_adminuser_moderator))
	{
	$user_email = ''.$department_adminuser_view_moderator['user_email'].'';
	$user_fullname = ''.$department_adminuser_view_moderator['user_firstname'].' '.$department_adminuser_view_moderator['user_lastname'].'<br/>';
	$mail->AddCC(''.$user_email.'', ''.$user_fullname.'');
	}
	
    //Content
	$mail->isHTML(true);
	$mail->Subject = 'DLSMHSI ONLINE FORMS | FORM SENT TO ADMIN / MODERATOR';
	
	$mail->Body   .= '<p><b>'.$colleges_department_code.'Admins/Moderators,</b> <br/> <b>'.$fullname.'</b> of <b>'.$colleges_department_code_sender.'</b> has been successfully sent form to be approved <b>'.$file_description.'</b> at <b>'.$colleges_department_code.'</b> attach below.</p>';
	$mail->Body   .= '<h2><b>Form Sent Information</b></h2>';
	$mail->Body   .= '
	<ul>
	<li> <b>Form:</b> <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location.'/'.$file_name.'" class="btn btn-success btn-xs"> '.$file_name.' <i>(click here to view)</i></a></li>
	<li> <b>Form Name:</b> '.$file_description.'</li>
	<li> <b>Email:</b> '.$email.'</li>
	<li> <b>Sent By:</b> '.$fullname.'</li>
	<li> <b>Date Sent:</b> '.$new_date_sent_convert.'</li>
	<li> <b>Time Sent:</b> '.$new_time_sent_convert.'</li>
	<li> <b>Department Name:</b> '.$colleges_department_code.' - '.$department_name.'</li>
	<li> <b>List of Signatories:</b><br/>';
	$signatory_user_level = mysqli_query($conn, "SELECT * FROM file_with_approvals WHERE file_id = '$file_id' && date_download = '$date_sent' && time_download1 = '$time_sent1'");
	while($signatory_user_level_view=mysqli_fetch_array($signatory_user_level)){
		$signatory = ''.$signatory_user_level_view['signatory'].'';
		$signatory_level = ''.$signatory_user_level_view['signatory_level'].'';
		
		$select_user_signatory = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$signatory'");
		while($select_user_signatory_view=mysqli_fetch_array($select_user_signatory))
		{
			$user_signatory_dept_id = ''.$select_user_signatory_view['user_dept'].'';
			$department_user = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE id = '$user_signatory_dept_id'");
			$department_user_show = mysqli_fetch_array($department_user);
			$colleges_department_name1 = $department_user_show['colleges_department_name'];
			$colleges_department_code_signatory = $department_user_show['colleges_department_code'];
			if($signatory_level == '1'){
				$signatory_name = ''.$colleges_department_code_signatory.' - '.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].' <b>CONFORME</b> <a href = "https://dlshsi.forms.mameceaafw.com/user.php?cieti_user_id='.$select_user_signatory_view['random_code'].'" target = "_blank">view info</a><br/>';
			}elseif($signatory_level == '2'){
				$signatory_name = ''.$colleges_department_code_signatory.' - '.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].' <b>ENDORSED</b> <a href = "https://dlshsi.forms.mameceaafw.com/user.php?cieti_user_id='.$select_user_signatory_view['random_code'].'" target = "_blank">view info</a><br/>';
			}elseif($signatory_level == '3'){
				$signatory_name = ''.$colleges_department_code_signatory.' - '.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].' <b>RECOMMENDED</b> <a href = "https://dlshsi.forms.mameceaafw.com/user.php?cieti_user_id='.$select_user_signatory_view['random_code'].'" target = "_blank">view info</a><br/>';
			}elseif($signatory_level == '4'){
				$signatory_name = ''.$colleges_department_code_signatory.' - '.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].' <b>APPROVED</b> <a href = "https://dlshsi.forms.mameceaafw.com/user.php?cieti_user_id='.$select_user_signatory_view['random_code'].'" target = "_blank">view info</a><br/>';
			}
			$mail->Body   .= ''.$signatory_name.'';
		}
	}
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
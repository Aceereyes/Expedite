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
	
	$signatory_user_level = mysqli_query($conn, "SELECT * FROM file_with_approvals WHERE file_id = '$file_id' && date_download = '$date_download' && time_download1 = '$time_download1'");
	while($signatory_user_level_view=mysqli_fetch_array($signatory_user_level)){
		$signatory = ''.$signatory_user_level_view['signatory'].'';
		$signatory_level = ''.$signatory_user_level_view['signatory_level'].'';
		
		$select_user_signatory = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$signatory'");
		while($select_user_signatory_view=mysqli_fetch_array($select_user_signatory))
		{
			$user_email_signatory = ''.$select_user_signatory_view['user_email'].'';
			$user_firstname_mail = ''.$select_user_signatory_view['user_firstname'].'';
			$user_lastname_mail = ''.$select_user_signatory_view['user_lastname'].'';
			$mail->AddCC(''.$user_email_signatory.'', ''.$user_firstname_mail.' '.$user_lastname_mail.'');
		}
	}
	
		
    //Content
	$mail->isHTML(true);
	$mail->Subject = 'DLSMHSI ONLINE FORMS | FORM COMPLETED';
	
	$select_user_signatory_approved = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$signatory'");
	$select_user_signatory_approved_view=mysqli_fetch_array($select_user_signatory_approved);
	$user_signatory_user_id = ''.$select_user_signatory_approved_view['user_id'].'';
	
	$sel_user = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_id'"); 
	$sel_user_display = mysqli_fetch_assoc($sel_user); 
	$user_firstname_file_sender = $sel_user_display['user_firstname'];
	$user_middlename_file_sender = $sel_user_display['user_middlename'];
	$user_lastname_file_sender = $sel_user_display['user_lastname'];
	$user_dept_file_sender = $sel_user_display['user_dept'];
	$user_priviledge_level_file_sender = $sel_user_display['user_priviledge_level'];
	
	
	$signatory_name_approved = '<b>Good day,</b><br/>The form submitted by <b>'.$user_firstname_file_sender.' '.$user_middlename_file_sender.' '.$user_lastname_file_sender.'</b> of <b>'.$colleges_department_code_sender.'</b> - <b>'.$user_priviledge_level_file_sender.'</b> has been successfully approved by all signatories of <b>'.$file_description.'</b>.<br/><br/>';
	
	$mail->Body   .= ''.$signatory_name_approved.'<br/>';
	
	
	$mail->Body   .= '<h2><b>Form Sent Information</b></h2>';
	$mail->Body   .= '
	<ul>
	<li> <b>Form:</b> Click <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location.'/'.$file_name.'" class="btn btn-success btn-xs"> '.$file_name.' <i>(click here to view)</i></a></li>';
	if($attachment == '0'){
		$mail->Body   .= '<li> <b>Form Attachment:</b> NO ATTACHMENT</li>';
	}else{
		$mail->Body   .= '<li> <b>Form Attachment:</b> Click <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location_attachment.'/'.$attachment.'" class="btn btn-success btn-xs"> '.$attachment.' <i>(click here to view)</i></a></li>';
	}
	$mail->Body   .= '
	<li> <b>Form Name:</b> '.$file_description.'</li>
	<li> <b>Email:</b> '.$email.'</li>
	<li> <b>Sent By:</b> '.$fullname.'</li>
	<li> <b>Date Sent:</b> '.$new_date_sent_converted.'</li>
	<li> <b>Time Sent:</b> '.$new_time_download_converted.'</li>
	<li> <b>Department Name:</b> '.$dept_code.' - '.$dept_name.'</li>
	<li> <b>List of Signatories:</b><br/>';
	$signatory_user_level = mysqli_query($conn, "SELECT * FROM file_with_approvals WHERE file_id = '$file_id' && date_download = '$date_download' && time_download1 = '$time_download1'");
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
				$signatory_name = ''.$colleges_department_code_signatory.' - '.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].' <b>CONFORME</b> <a href = "mameceaafw.com/form/user.php?cieti_user_id='.$select_user_signatory_view['random_code'].'" target = "_blank">view info</a><br/>';
			}elseif($signatory_level == '2'){
				$signatory_name = ''.$colleges_department_code_signatory.' - '.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].' <b>ENDORSED</b> <a href = "mameceaafw.com/form/user.php?cieti_user_id='.$select_user_signatory_view['random_code'].'" target = "_blank">view info</a><br/>';
			}elseif($signatory_level == '3'){
				$signatory_name = ''.$colleges_department_code_signatory.' - '.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].' <b>RECOMMENDED</b> <a href = "mameceaafw.com/form/user.php?cieti_user_id='.$select_user_signatory_view['random_code'].'" target = "_blank">view info</a><br/>';
			}elseif($signatory_level == '4'){
				$signatory_name = ''.$colleges_department_code_signatory.' - '.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].' <b>APPROVED</b> <a href = "mameceaafw.com/form/user.php?cieti_user_id='.$select_user_signatory_view['random_code'].'" target = "_blank">view info</a><br/>';
			}
			$mail->Body   .= ''.$signatory_name.'';
		}
	}
	$mail->Body   .= '
	</li></ul>
	</ul>
	<br/>
	<br/> '.$email_signature.'
	<br/>
	<br/>
	Check form status ? <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"> Login</a>';
	
    $mail->send();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
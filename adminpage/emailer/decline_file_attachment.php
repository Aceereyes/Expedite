<?php
require 'email_sender/PHPMailer/src/Exception.php';
require 'email_sender/PHPMailer/src/PHPMailer.php';
require 'email_sender/PHPMailer/src/SMTP.php';

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

	$select_user_signatory_approved = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$signatory'");
	$select_user_signatory_approved_view=mysqli_fetch_array($select_user_signatory_approved);
	$user_signatory_user_id = ''.$select_user_signatory_approved_view['user_id'].'';
	$user_firstname = ''.$select_user_signatory_approved_view['user_firstname'].'';
	$user_middlename = ''.$select_user_signatory_approved_view['user_middlename'].'';
	$user_lastname = ''.$select_user_signatory_approved_view['user_lastname'].'';
	$user_email = ''.$select_user_signatory_approved_view['user_email'].'';
	$user_dept = ''.$select_user_signatory_approved_view['user_dept'].'';
	
    //Recipients
    $mail->setFrom('zoomaster@mameceaafw.com', 'DLSMHSI');
	$mail->addAddress(''.$user_email.'', ''.$user_firstname.' '.$user_middlename.' '.$user_lastname.'');
	
	$file_uploads_signatory = mysqli_query($conn, "SELECT * FROM signatory_level WHERE file_id = '$file_id'");
	while($file_uploads_signatoryt_view = mysqli_fetch_array($file_uploads_signatory)){
		$user_signatory = ''.$file_uploads_signatoryt_view['user_signatory'].'';
		$user_signatory_level = ''.$file_uploads_signatoryt_view['user_signatory_level'].'';
		
		$select_user_signatory = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_signatory'");
		$select_user_signatory_view=mysqli_fetch_array($select_user_signatory);
		$user_firstname = $select_user_signatory_view['user_firstname'];
		$user_middlename = $select_user_signatory_view['user_middlename'];
		$user_lastname = $select_user_signatory_view['user_lastname'];
		$signatory_emails = $select_user_signatory_view['user_email'];
		$mail->AddCC(''.$signatory_emails.'', ''.$user_firstname.' '.$user_middlename.' '.$user_lastname.'');
	}
	
    //Content
	$mail->isHTML(true);
	$mail->Subject = 'DLSMHSI ONLINE FORMS | DECLINED';
	
	$select_user_signatory_approved = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$signatory'");
	$select_user_signatory_approved_view=mysqli_fetch_array($select_user_signatory_approved);
	$user_signatory_user_id = ''.$select_user_signatory_approved_view['user_id'].'';
	
	$department_user = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE id = '$user_dept'");
	$department_user_show = mysqli_fetch_array($department_user);
	$colleges_department_name = $department_user_show['colleges_department_name'];
	$colleges_department_code = $department_user_show['colleges_department_code'];
	
	$user_file_owner = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_id_file_owner'");
	$user_file_owner_view=mysqli_fetch_array($user_file_owner);
	$user_signatory_user_id = ''.$user_file_owner_view['user_id'].'';
	$user_firstname_owner = ''.$user_file_owner_view['user_firstname'].'';
	$user_middlename_owner = ''.$user_file_owner_view['user_middlename'].'';
	$user_lastname_owner = ''.$user_file_owner_view['user_lastname'].'';
	$user_dept_owner = ''.$user_file_owner_view['user_dept'].'';
	
	$department_owner = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE id = '$user_dept_owner'");
	$department_owner_show = mysqli_fetch_array($department_owner);
	$colleges_department_name_owner = $department_owner_show['colleges_department_name'];
	$colleges_department_code_owner = $department_owner_show['colleges_department_code'];
	
	$signatory_name_approved = 'The form <b>'.$file_description.'</b> submitted by <b>'.$user_firstname_owner.' '.$user_middlename_owner.' '.$user_lastname_owner.'</b> of <b>'.$colleges_department_code_owner.'</b>, has been decline by <b>'.$user_firstname.' '.$user_middlename.' '.$user_lastname.'</b> of <b>'.$colleges_department_code.'</b>.';
	
	$mail->Body   .= ''.$signatory_name_approved.'<br/><br/>';
	$mail->Body   .= '<b>Reason of Decline:</b> '.$decline_reason.'';
	
	$mail->Body   .= '<h2><b>Form Sent Information</b></h2>';
	$mail->Body   .= '
	<ul>
	<li> <b>Form:</b> Click <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location.'/'.$file_name.'" class="btn btn-success btn-xs"> '.$file_name.' <i>(click here to view)</i></a></li>
	<li> <b>Form Attached:</b> <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location_attachment.'/'.$attachment.'" class="btn btn-success btn-xs"> '.$attachment.' <i>(click here to view)</i></a></li>
	<li> <b>Form Name:</b> '.$file_description.'</li>
	<li> <b>Email:</b> '.$email.'</li>
	<li> <b>Sent By:</b> '.$fullname.'</li>
	<li> <b>Date Sent:</b> '.$new_date_download_convert.'</li>
	<li> <b>Time Sent:</b> '.$new_time_download_convert.'</li>
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
	Check your form status ? <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"> Login</a>';
	
    $mail->send();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
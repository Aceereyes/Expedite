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
	
	$signatory_user_level_mail = mysqli_query($conn, "SELECT MIN(signatory_level) as sig_level FROM file_with_approvals WHERE file_id = '$file_id' && date_download = '$date_download' && time_download1 = '$time_download1' && file_status = 'PENDING' && approval = '0'");
	$signatory_user_level_mail_view=mysqli_fetch_array($signatory_user_level_mail);
	$sig_level = $signatory_user_level_mail_view['sig_level'];
	
	
		$new_file_sig_level = mysqli_query($conn, "SELECT * FROM file_with_approvals WHERE signatory_level = '$sig_level' && file_id = '$file_id' && date_download = '$date_download' && time_download1 = '$time_download1' && file_status = 'PENDING' && approval = '0'");
		$new_file_sig_level_view=mysqli_fetch_array($new_file_sig_level);
	
		$signatory_mail = ''.$new_file_sig_level_view['signatory'].'';
		$signatory_level = ''.$new_file_sig_level_view['signatory_level'].'';
		$select_user_signatory_mail = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$signatory_mail'");
		$select_user_signatory_mail_view=mysqli_fetch_array($select_user_signatory_mail);
		$user_email_sig = ''.$select_user_signatory_mail_view['user_email'].'';
		$user_fullname_sig = ''.$select_user_signatory_mail_view['user_firstname'].' '.$select_user_signatory_mail_view['user_lastname'].'';
		
		$mail->addAddress(''.$user_email_sig.'', ''.$user_fullname_sig.'');
	
    //Content
	$mail->isHTML(true);
	$mail->Subject = 'DLSMHSI ONLINE FORMS | REMINDER';
	
	$select_user_signatory_approved = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$signatory'");
	$select_user_signatory_approved_view=mysqli_fetch_array($select_user_signatory_approved);
	$user_signatory_user_id = ''.$select_user_signatory_approved_view['user_id'].'';
	$user_dept_user_id = ''.$select_user_signatory_approved_view['user_dept'].'';
	$department_user = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE id = '$user_dept_user_id'");
	$department_user_show = mysqli_fetch_array($department_user);
						
								
	$signatory_name_approved = '<b>'.$user_fullname_sig.',</b> <br/>This is to inform you that you are required to respond to form <b>'.$file_description.'</b> sent by <b>'.$user_firstname.' '.$user_lastname.'</b> of <b>'.$colleges_department_code_sender.'.</b><br/><br/>';
	$mail->Body   .= ''.$signatory_name_approved.'';
	$mail->Body   .= '<h2><b>File Sent Information</b></h2>';
	$mail->Body   .= '
	<ul>
	<li> <b>File:</b> Click <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location.'/'.$file_name.'" class="btn btn-success btn-xs"> '.$file_name.' <i>(click here to view)</i></a></li>
	<li> <b>File Attachment:</b> Click <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location_attachment.'/'.$attachment.'" class="btn btn-success btn-xs"> '.$attachment.' <i>(click here to view)</i></a></li>
	<li> <b>File Name:</b> '.$file_description.'</li>
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
	Check your file status ? <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"> Login</a>';
	
    $mail->send();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
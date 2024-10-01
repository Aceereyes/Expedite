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
	$mail->addAddress(''.$user_email.'', ''.$user_firstname.' '.$user_middlename.' '.$user_lastname.'');
	
    //Content
	$mail->isHTML(true);
	$mail->Subject = 'DLSMHSI ONLINE FORMS | DECLINED';
	
	
	$department_user = mysqli_query($conn, "SELECT * FROM collegesdepartment WHERE id = '$ADMIN_USER_DEPARTMENT'");
	$department_user_show = mysqli_fetch_array($department_user);
	$colleges_department_name = $department_user_show['colleges_department_name'];
	$colleges_department_code = $department_user_show['colleges_department_code'];
						

	$signatory_name_approved = '<b>'.$ADMIN_FIRSTNAME.' '.$ADMIN_MIDDLENAME.' '.$ADMIN_LASTNAME.'</b> of <b>'.$colleges_department_code.'</b> has been declined your form <b>'.$file_description.'</b>.';
	
	$mail->Body   .= ''.$signatory_name_approved.'<br/><br/>';
	$mail->Body   .= '<b>Reason of Decline:</b> '.$decline_reason.'';
	
	$mail->Body   .= '<h2><b>Form Sent Information</b></h2>';
	$mail->Body   .= '
	<ul>
	<li> <b>Form Sended:</b> Click <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location.'/'.$file_name.'" class="btn btn-success btn-xs"> '.$file_name.' <i>(click here to view)</i></a></li>';
	if($attachment!= ''){
	$mail->Body   .= '
	<li> <b>Form Attachment:</b> Click <a href = "https://dlshsi.forms.mameceaafw.com/'.$file_location_attachment.'/'.$attachment.'" class="btn btn-success btn-xs"> '.$attachment.' <i>(click here to view)</i></a></li>';
	}
	$mail->Body   .= '
	<li> <b>Form Name:</b> '.$file_description.'</li>
	<li> <b>Email:</b> '.$email.'</li>
	<li> <b>Date & Time Sent:</b> '.$new_date_sent_converted.' | '.$new_time_download_converted.'</li>
	<li> <b>Department Name:</b> '.$dept_code.' - '.$dept_name.'</li>
	</ul>
	<br/>
	<br/>
	Check form status ? <a href = "https://dlshsi.forms.mameceaafw.com/login.php" class="btn btn-success btn-xs"> <i class="fa fa-unlock"> Login</a>';
	
    $mail->send();
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
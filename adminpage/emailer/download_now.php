<?php
require 'email_sender/PHPMailer/src/Exception.php';
require 'email_sender/PHPMailer/src/PHPMailer.php';
require 'email_sender/PHPMailer/src/SMTP.php';

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
	$mail->addAddress(''.$email.'', ''.$fullname.'');
	
	//Content
	$mail->isHTML(true);
	$mail->Subject = 'DLSMHSI ONLINE FORMS | FORM DOWNLOAD';
	
	$mail->Body   .= '<p><b>'.$fullname.'</b>, you have successfully downloaded form <b>'.$file_description.'</b> attach below</p>';
	
	$mail->Body   .= '<h2><b>Form Information</b></h2>';
	$mail->Body   .= '
	<ul>
	<li> <b>Form:</b> <a href = "https://dlshsi.forms.mameceaafw.com/file_uploads/'.$file_name.'" class="btn btn-success btn-xs"> '.$file_name.' <i>(click here to view)</i></a></li>
	<li> <b>Form Name:</b> '.$file_description.'</li>
	<li> <b>Email:</b> '.$email.'</li>
	<li> <b>Uploaded By:</b> '.$uploadedby.'</li>
	<li> <b>Date Uploaded:</b> '.$new_date_uploaded_convert.'</li>
	<li> <b>Time Uploaded:</b> '.$new_time_uploaded_convert.'</li>
	<li> <b>Department Name:</b> '.$dept_code.' - '.$dept_name.'</li>';
	if($file_type == 'FILE_WITH_APPROVAL'){
	$mail->Body   .= '<li> <b>List of Signatories:</b>';
	}
	$select_user_signatory = mysqli_query($conn, "SELECT * FROM signatory_level WHERE file_id = '$file_id'");
	while($select_user_signatory_view=mysqli_fetch_array($select_user_signatory))
	{
		$signatory_list =  ''.$select_user_signatory_view['user_signatory'].'';
		$user_signatory_level =  ''.$select_user_signatory_view['user_signatory_level'].'';
		
		if($user_signatory_level == '1'){
			$signatory_user = 'REGULAR';
		}elseif($user_signatory_level == '2'){
			$signatory_user = 'CONFORME';
		}elseif($user_signatory_level == '3'){
			$signatory_user = 'ENDORSED';
		}elseif($user_signatory_level == '4'){
			$signatory_user = 'RECOMMENDED';
		}elseif($user_signatory_level == '5'){
			$signatory_user = 'APPROVED';
		}
		
		$select_user = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$signatory_list'");
		$select_user_view = mysqli_fetch_array($select_user); 
		$user_firstname = $select_user_view['user_firstname'];
		$user_lastname = $select_user_view['user_lastname'];
			
		$mail->Body   .= '<br/>'.$user_firstname.' '.$user_lastname.' - '.$signatory_user.'';	
	}
	$mail->Body   .= '
	</li>
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
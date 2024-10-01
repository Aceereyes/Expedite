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
	$mail->Username   = "jms@mameceaafw.com";
	$mail->Password   = "vo=WD+XxDt";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('jms@mameceaafw.com', 'JMS INQUIRY');
	$mail->addAddress(''.$email.'', ''.$name.'');
	
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'JMS AUTO RESPONSE';
    $mail->Body    = '
	<b>'.$name.'</b>,
	<br>
	<br>
	Thanks so much for reaching out! This auto-reply is just to let you know.
	<br>
	We received your email and will get back to you with a (human) response as soon as possible.
	<br>During <b>'.$businesstime.'</b> that\'s usually within a couple of hours.
	<br> Evenings and weekends may take us a little bit longer.
	<br><br>
	If you have any additional information that you think will help us to assist you, 
	<br>please feel free to reply to this email.
	<br>We look forward to chatting you soon!
	
	<br>
	<br>
	<br>
	<br>
	<h2><b>JMS</b> Jerico Mark</h2>
	<b>Trading & General Services<br></b>
	Electronic | Electrical | Ref & Aircon<br>
	M.H Del Pilar St. San Vicente I Silang, Cavite<br>
	(0927) 606 6912 | (046) 487 3694 | jms.jericomarktrading@gmail.com';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
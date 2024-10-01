<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/PHPMailerAutoload.php';

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
    $mail->setFrom('dlshsi@dlshsi.edu.ph', 'DLSHSI');
	$mail->addAddress('lflorena@dlshsi.edu.ph');
    $mail->addReplyTo('zoomaster@mameceaafw.com', 'Information');
    $mail->addCC('lorenz.lorena@yahoo.com');
    $mail->addCC('kylin_26@yahoo.com');
    $mail->addBCC('lflorena05@gmail.com');
	
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'MAGIINOM AKO';
    $mail->Body    = 'Pag eto gumana magiinom ako mamaya para mag-celebrate!!!';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
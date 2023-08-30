<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require base_path("/vendor/autoload.php");

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer:: ENCRYPTION_SMTPS;
$mail->Port = 465;
$mail->Username = 'mhd.abd51@gmail.com';
$mail->Password = 'hwahfupowjrtvuna';

$mail->isHTML(true);

return $mail;
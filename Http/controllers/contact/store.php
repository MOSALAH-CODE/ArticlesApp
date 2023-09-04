<?php

use Core\Mailer;
use Http\Forms\ContactForm;

$name = $_POST["name"];
$email = $_POST["email"];
$phoneNumber = $_POST["phone-number"];
$message = $_POST["message"];

$form = ContactForm::validate($attributes = [
    'name' => $name,
    'email' => $email,
    'phone-number' => $phoneNumber,
    'message' => $message,
]);


$mailer = new Mailer();
$mailer->sendEmail('mhd.abd51@gmail.com', 'Contact Form Submission', "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Phone Number:</strong> $phoneNumber<br><strong>Message:</strong> $message");

require base_path("includes/success/password_reset.php");
die();

?>

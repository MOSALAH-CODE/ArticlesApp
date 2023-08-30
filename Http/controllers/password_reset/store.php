<?php

use Core\Input;
use Http\Forms\SendMailToResetForm;

$email = Input::get('email');

$form = SendMailToResetForm::validate($attributes = [
    'email' => $email
]);

$token = bin2hex(random_bytes(16));

$token_hash = hash('sha256', $token);

date_default_timezone_set('Europe/Istanbul');

$expiry = date("Y-m-d H:i:s", time());

$user = \Core\App::resolve(\Core\Database::class)->get('users', ['email', '=', $email])->first();

if (!empty($user)){
    \Core\App::resolve(\Core\Database::class)->insert('password_resets',[
        'user_id'=>$user['id'],
        'token'=>$token_hash,
        'expiration'=> $expiry
    ]);

    $mail = require base_path('Core/mailer.php');
    $mail->setFrom("noreply@example.com"); // Here is the correction
    $mail->addAddress($email);
    $mail->Subject = "Reset password";
    $mail->Body = <<<END
    Hi {$user['name']},
    Click <a href="http://localhost:8888/reset-password-token?token=$token">Here</a> 
    to reset your password
    END;

    try {
        $mail->send();
    }catch (Exception $e){
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
    \Core\Session::flash('success', "Check your inbox for password reset instructions.");
    require base_path("includes/success/password_reset.php");
    die();
}else{
    $form->error(
        'email', "Oops! The email you entered wasn't found. Please check and try again!"
    )->throw();
}



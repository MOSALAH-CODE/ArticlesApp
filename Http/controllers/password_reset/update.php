<?php

use Core\Authenticator;
use Core\Input;
use Core\Redirect;
use Http\Forms\ResetPasswordForm;

$form = ResetPasswordForm::validate($attributes = [
    'password' => Input::get('password'),
    'confirm_password' => Input::get('confirm_password')
]);

$passwordReset = (new Authenticator)->resetPasswordAttempt(
    Input::get('email'), $attributes['password']
);

if (!$passwordReset){
    $form->error(
        'reset_password', 'Password reset error.'
    )->throw();
}

Redirect::to('/');
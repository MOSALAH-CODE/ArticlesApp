<?php

use Core\Authenticator;
use Core\Redirect;
use Http\Forms\RegisterForm;


$form = RegisterForm::validate($attributes = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'confirm_password' => $_POST['confirm_password']
]);

$userCreated = (new Authenticator)->registerAttempt(
    $attributes['email'], $attributes['password'], $attributes['name']
);

if (!$userCreated) {
    $form->error(
        'email', 'This email is already in use. Please log in or use a different email to create an account.'
    )->throw();
}

Redirect::to('/');
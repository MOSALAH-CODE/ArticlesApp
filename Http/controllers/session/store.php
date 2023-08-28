<?php

use Core\Authenticator;
use Core\Redirect;
use Http\Forms\LoginForm;


$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);


$signedIn = (new Authenticator)->loginAttempt(
    $attributes['email'], $attributes['password']
);

if (!$signedIn) {
    $form->error(
        'email', 'No matching account found for that email address and password.'
    )->throw();
}

Redirect::to('/');

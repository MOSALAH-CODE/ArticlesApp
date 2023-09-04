<?php

use Core\Authenticator;
use Core\Input;
use Core\Redirect;
use Http\Forms\LoginForm;


$form = LoginForm::validate($attributes = [
    'email' => Input::get('email'),
    'password' => Input::get('password')
]);

$remember = Input::get('remember') === 'on';
$signedIn = (new Authenticator)->loginAttempt(
    $attributes['email'], $attributes['password'], $remember
);

if ($signedIn === -1) {
    $form->error(
        'email', 'Please verify your account'
    )->throw();
}
if (!$signedIn) {
    $form->error(
        'email', 'No matching account found for that email address and password.'
    )->throw();
}

Redirect::to('/');

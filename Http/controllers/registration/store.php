<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Redirect;
use Core\Validator;


$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
   $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}


$user = $db->get('users', ['email', '=', $email])->first();

if ($user) {
    Redirect::to('/');
} else {
    $db->insert('users', [
        'email'=>$email,
        'password'=>password_hash($password, PASSWORD_BCRYPT)
        ]);

    (new Authenticator())->login($user);

    Redirect::to('/');
}

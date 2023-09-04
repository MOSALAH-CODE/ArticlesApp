<?php

use Core\Session;

$token = \Core\Input::get('token');

$token_hash = hash("sha256", $token);

$password_reset = \Core\App::resolve(\Core\Database::class)->get('password_resets', ['token', '=', $token_hash])->first();

if (!$password_reset){
    dd("token not found");
}

date_default_timezone_set('Europe/Istanbul');

if (strtotime($password_reset['expiration']) <= time() ){
    dd("token has expired");
}

view('password_reset/update.view.php', [
    'errors' => Session::get('errors'),
    'user_id'=> $password_reset['user_id']
]);


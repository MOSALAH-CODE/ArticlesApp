<?php

use Core\Session;

$token = \Core\Input::get('token');

$token_hash = hash("sha256", $token);

$account_verification = \Core\App::resolve(\Core\Database::class)->get('account_verifications', ['token', '=', $token_hash])->first();

if (!$account_verification){
    dd("token not found");
}

date_default_timezone_set('Europe/Istanbul');

if ((strtotime($account_verification['expiration'])) <= time() ){
    dd("token has expired");
}

\Core\App::resolve(\Core\Database::class)->update('users', $account_verification['user_id'], [
    'status' => 'verified'
]);

\Core\App::resolve(\Core\Database::class)->delete('account_verifications', ['token', '=', $account_verification['token']]);

view('registration/verifyAccount/index.view.php', []);


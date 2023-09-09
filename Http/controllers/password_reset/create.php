<?php

use Core\Session;

$user = new \Core\User();

$loggedIn = $user->isLoggedIn();

view('password_reset/create.view.php', [
    'errors' => Session::get('errors'),
    'loggedIn' => $loggedIn,
    'user' => $user->data() !== null ? $user->data(): ''

]);

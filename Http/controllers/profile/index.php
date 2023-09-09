<?php

$user = new \Core\User();

if ($user->isLoggedIn()) {
    view("profile/index.view.php", [
        'user' => $user->data()
    ]);
} else {
    \Core\Redirect::to('/login');
}


<?php

$user = new \Core\User();

if ($user->isLoggedIn()){
    view("profile/edit.view.php", [
        'user' => $user->data(),
        'errors' => \Core\Session::get('errors')
    ]);
}else{
    \Core\Redirect::to('/login');
}



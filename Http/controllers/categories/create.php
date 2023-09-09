<?php

$user = new \Core\User();

// Check if the user is logged in
if ($user->isLoggedIn()) {

    authorize($user->hasPermission('admin'));

    view("categories/create.view.php", [
        'heading' => 'Create category',
        'errors' => \Core\Session::get('errors')
    ]);
}else{
    \Core\Redirect::to('/login');
}


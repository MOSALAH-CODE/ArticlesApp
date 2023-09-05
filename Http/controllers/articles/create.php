<?php

$user = new \Core\User();

// Check if the user is logged in
if ($user->isLoggedIn()) {
    view("articles/create.view.php", [
        'heading' => 'Create article',
        'errors' => \Core\Session::get('errors')
    ]);
}else{
    \Core\Redirect::to('/login');
}


<?php

$user = new \Core\User();

if ($user->isLoggedIn()){

    authorize($user->hasPermission('admin'));

    $category = \Core\App::resolve(\Core\Database::class)->get('categories', ['id', '=', $_GET['id']])->first();

    if (empty($category)){
        abort();
    }

    view("categories/edit.view.php", [
        'heading'=>'Edit category',
        'category'=>$category,
        'errors' => \Core\Session::get('errors')
    ]);
}else{
    \Core\Redirect::to('/login');
}



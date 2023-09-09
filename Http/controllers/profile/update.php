<?php

use Core\App;
use Core\Input;
use Core\Redirect;
use Core\Validator;
use Core\Database;
use Core\Session;
use Http\Forms\ArticleForm;
use Http\Forms\CategoryForm;
use Http\Forms\ProfileForm;

$user = new \Core\User();

// Check if the user is logged in
if ($user->isLoggedIn()) {

    authorize($user->data()['id'] === (int)Input::get('id'));

    $db = App::resolve(Database::class);

    $form = ProfileForm::validate($attributes = [
        'name' => Input::get('name'),
        'email' => Input::get('email'),
    ]);

    $form->updateProfile($user->data()['id']);

    Redirect::to('/profile');

}else {
    Redirect::to('/login');
}
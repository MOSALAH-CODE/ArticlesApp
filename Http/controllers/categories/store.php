<?php
use Core\App;
use Core\Input;
use Core\Redirect;
use Core\Validator;
use Core\Database;
use Core\Session;
use Http\Forms\ArticleForm;
use Http\Forms\CategoryForm;

$user = new \Core\User();

// Check if the user is logged in
if ($user->isLoggedIn()) {

    $db = App::resolve(Database::class);

    $form = CategoryForm::validate($attributes = [
        'name' => Input::get('name'),
        'description' => Input::get('description'),
    ]);

    $form->createCategory();

    Redirect::to('/categories');

}else {
    Redirect::to('/login');
}


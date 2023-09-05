<?php
use Core\App;
use Core\Input;
use Core\Redirect;
use Core\Validator;
use Core\Database;
use Core\Session;
use Http\Forms\ArticleForm;

$user = new \Core\User();

// Check if the user is logged in
if ($user->isLoggedIn()) {

    $db = App::resolve(Database::class);

    $form = ArticleForm::validate($attributes = [
        'title' => Input::get('title'),
        'description' => Input::get('description'),
        'content' => Input::get('content'),
        'categories' => Input::get('categories'),
        'category' => Input::get('category'),
    ]);

    $imageUrl = $form->uploadImage($_FILES['image']);

    $category_id = $form->setCategory();

    $form->createArticle($user->data()['id'], $category_id, $imageUrl);

    Redirect::to('/articles');

}else {
    Redirect::to('/login');
}


<?php

use Core\App;
use Core\Database;
use Core\Redirect;
use Core\Validator;

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);

// find the corresponding article
$article = $db->get('articles', ['id', '=', $_POST['id']])->first();

// authorize that the current user can edit the article
authorize($article['user_id'] === $currentUser['id']);

// validate the form
$errors = [];

if (!Validator::string($_POST['description'], 10, 1000)) {
    $errors['content'] = 'A description of 10 to 1,000 characters is required.

';
}

if (!Validator::string($_POST['content'], 100, 10000)) {
    $errors['content'] = 'A content of 100 to 10,000 characters is required.';
}

// if no validation errors, update the record in the articles database table.
if (count($errors)) {
    return view('articles/edit.view.php', [
        'heading' => 'Edit article',
        'errors' => $errors,
        'article' => $article
    ]);
}

$db->update('articles', $_POST['id'], ['content' => $_POST['content']]);

// redirect the user
Redirect::to('/articles');


<?php

use Core\App;
use Core\Redirect;
use Core\Validator;
use Core\Database;


if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}


$db = App::resolve(Database::class);
$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->insert('notes', [
    'body' => $_POST['body'],
    'user_id' => $currentUser['id']
]);


Redirect::to('/notes');


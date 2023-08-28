<?php

use Core\App;
use Core\Database;
use Core\Redirect;
use Core\Validator;

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);

// find the corresponding note
$note = $db->get('notes', ['id', '=', $_POST['id']])->first();

// authorize that the current user can edit the note
authorize($note['user_id'] === $currentUser['id']);

// validate the form
$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

// if no validation errors, update the record in the notes database table.
if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->update('notes', $_POST['id'], ['body' => $_POST['body']]);

// redirect the user
Redirect::to('/notes');


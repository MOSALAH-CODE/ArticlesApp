<?php

use Core\App;
use Core\Database;

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);


$note = $db->get('notes', ['id', '=', $_GET['id']])->first();

authorize($note['user_id'] === $currentUser['id']);

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);

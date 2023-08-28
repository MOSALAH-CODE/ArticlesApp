<?php

use Core\App;
use Core\Database;

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);
$notes = $db->get('notes', ['user_id', '=', $currentUser['id']])->results();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
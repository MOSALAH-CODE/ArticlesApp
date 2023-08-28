<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$notes = $db->get('notes', ['user_id', '=', 1])->results();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
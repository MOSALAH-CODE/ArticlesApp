<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->get('notes', ['id', '=', $_POST['id']])->first();

authorize($note['user_id'] === $currentUserId);

$db->delete('notes', ['id', '=', $_POST['id']]);

header('location: /notes');
exit();

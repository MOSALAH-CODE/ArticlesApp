<?php

use Core\App;
use Core\Database;
use Core\Redirect;

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->get('notes', ['id', '=', $_POST['id']])->first();

authorize($note['user_id'] === $currentUser['id']);

$db->delete('notes', ['id', '=', $_POST['id']]);

Redirect::to('/notes');
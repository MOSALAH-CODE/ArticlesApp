<?php

use Core\App;
use Core\Database;
use Core\Redirect;

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);

$article = $db->get('articles', ['id', '=', $_POST['id']])->first();

authorize($article['author_id'] === $currentUser['id']);

$db->delete('articles', ['id', '=', $_POST['id']]);

Redirect::to('/articles');
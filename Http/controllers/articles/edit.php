<?php

use Core\App;
use Core\Database;

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);

$article = $db->get('articles', ['id', '=', $_GET['id']])->first();


authorize($article['author_id'] === $currentUser['id']);

view("articles/edit.view.php", [
    'heading' => 'Edit article',
    'errors' => [],
    'article' => $article
]);
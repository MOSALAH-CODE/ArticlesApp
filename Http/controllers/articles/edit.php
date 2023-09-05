<?php

use Core\App;
use Core\Database;

$user = new \Core\User();

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);

$article = $db->get('articles', ['id', '=', $_GET['id']])->first();

if (empty($article)){
    abort();
}

$hasPermission = hasPermission($user, $article['author_id']);

authorize($hasPermission);

view("articles/edit.view.php", [
    'heading' => 'Edit article',
    'errors' => \Core\Session::get('errors'),
    'article' => $article
]);
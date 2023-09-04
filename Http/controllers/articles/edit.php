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

$hasPermission = false;

if ($user->isLoggedIn()){
    $hasPermission = $article['author_id'] === $user->data()['id'];
    if (!$hasPermission){
        $hasPermission = $user->hasPermission('admin');
    }
}

authorize($hasPermission);

view("articles/edit.view.php", [
    'heading' => 'Edit article',
    'errors' => [],
    'article' => $article
]);
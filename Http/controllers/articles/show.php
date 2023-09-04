<?php

use Core\App;
use Core\Database;

$user = new \Core\User();

$db = App::resolve(Database::class);

$article = $db->get('articles', ['id', '=', $_GET['id']])->first();

$hasPermission = false;

if ($user->isLoggedIn()){
    $hasPermission = $article['author_id'] === $user->data()['id'];

    if (!$hasPermission){
        $hasPermission = $user->hasPermission('admin');
    }
}

view("articles/show.view.php", [
    'heading' => 'article',
    'article' => $article,
    'hasPermission' => $hasPermission
]);

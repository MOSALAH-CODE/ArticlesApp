<?php

use Core\App;
use Core\Database;
use Core\Redirect;

$user = new \Core\User();

$db = App::resolve(Database::class);

$article = $db->get('articles', ['id', '=', $_POST['id']])->first();

$hasPermission = false;

if ($user->isLoggedIn()){
    $hasPermission = $article['author_id'] === $user->data()['id'];
    if (!$hasPermission){
        $hasPermission = $user->hasPermission('admin');
    }
}

authorize($hasPermission);

$db->delete('articles', ['id', '=', $_POST['id']]);

Redirect::to('/');
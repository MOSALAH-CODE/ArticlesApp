<?php

$user = new \Core\User();

if ($user->isLoggedIn()) {
    $userId = $user->data()['id'];
}


$articles = \Core\App::resolve(\Core\Database::class)->get('articles')->results();

$hasPermission = [];


$x = 0;
foreach ($articles as $article){
    if ($user->isLoggedIn()){
        $hasPermissions[$x] = $article['author_id'] === $user->data()['id'];
        if (!$hasPermissions[$x]){
            $hasPermissions[$x] = $user->hasPermission('admin');
        }
    }else{
        $hasPermissions[$x] = false;
    }

    $x++;
}

view("index.view.php", [
    'heading' => 'Home',
    'articles'=> $articles,
    'user'=>$userId ?? '',
    'hasPermissions' => $hasPermissions
]);
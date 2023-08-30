<?php

if (\Core\Session::exists('user')) {
    $user = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$articles = \Core\App::resolve(\Core\Database::class)->get('articles')->results();

view("index.view.php", [
    'heading' => 'Home',
    'articles'=> $articles,
    'user'=>$user ?? ''
]);
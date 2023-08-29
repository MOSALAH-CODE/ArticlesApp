<?php

use Core\App;
use Core\Database;

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);
$articles = $db->get('articles', ['author_id', '=', $currentUser['id']])->results();

view("articles/index.view.php", [
    'heading' => 'My articles',
    'articles' => $articles
]);
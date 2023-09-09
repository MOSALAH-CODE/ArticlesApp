<?php

$category_id = $_GET['id'];

$category = \Core\App::resolve(\Core\Database::class)->get('categories', ['id', '=', $category_id])->first();
$articles = \Core\App::resolve(\Core\Database::class)->get('articles', ['category_id', '=', $category_id])->results();

$user = new \Core\User();

$hasPermission = $user->hasPermission('admin');


view("categories/show.view.php", [
    'articles'=>$articles,
    'category'=>$category,
    'hasPermission' => $hasPermission
]);
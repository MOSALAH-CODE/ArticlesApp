<?php

$user = new \Core\User();

$hasPermission = false;

if ($user->isLoggedIn()){
    $hasPermission = ($user->hasPermission('admin'));
}

$categories = \Core\App::resolve(\Core\Database::class)->get('categories')->results();

view("categories/index.view.php", [
    'categories'=>$categories,
    'hasPermission'=>$hasPermission
]);
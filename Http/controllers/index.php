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

// Include necessary files and database connection
if(isset($_POST['search'])){
    $searchTerm = $_POST['search'];

    $query = "SELECT articles.*, categories.name, users.name 
          FROM articles 
          LEFT JOIN categories ON articles.category_id = categories.id
          LEFT JOIN users ON articles.author_id = users.id
          WHERE articles.title LIKE '%$searchTerm%' 
          OR articles.description LIKE '%$searchTerm%'
          OR articles.content LIKE '%$searchTerm%'
          OR categories.name LIKE '%$searchTerm%'
          OR users.name LIKE '%$searchTerm%'";

    $articles = \Core\App::resolve(\Core\Database::class)->query($query)->results();
}

view("index.view.php", [
    'heading' => 'Home',
    'articles'=> $articles,
    'user'=>$userId ?? '',
    'hasPermissions' => $hasPermissions
]);
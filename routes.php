<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/articles', 'articles/index.php')->only('auth');
$router->get('/article', 'articles/show.php');
$router->delete('/article', 'articles/destroy.php');

$router->get('/article/edit', 'articles/edit.php');
$router->patch('/article', 'articles/update.php');

$router->get('/articles/create', 'articles/create.php');
$router->post('/articles', 'articles/store.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');

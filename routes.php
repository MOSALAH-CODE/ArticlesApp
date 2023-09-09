<?php

$router->get('/', 'index.php');
$router->delete('/', 'destroy.php');

//$router->get('/about', 'about.php');

$router->get('/contact', 'contact/index.php');
$router->post('/contact', 'contact/store.php');

$router->get('/articles', 'articles/index.php');
$router->get('/article', 'articles/show.php');
$router->delete('/article', 'articles/destroy.php')->only('auth');

$router->get('/article/edit', 'articles/edit.php')->only('auth');
$router->patch('/article', 'articles/update.php')->only('auth');

$router->get('/articles/create', 'articles/create.php')->only('auth');
$router->post('/articles', 'articles/store.php')->only('auth');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/verify', 'registration/verifyAccount/index.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');

$router->get('/reset-password', 'password_reset/create.php'); //->only('guest');
$router->post('/reset-password', 'password_reset/store.php'); //->only('guest');

$router->get('/reset-password-token', 'password_reset/show.php'); //->only('guest');
$router->patch('/reset-password-token', 'password_reset/update.php'); //->only('guest');

$router->get('/profile', 'profile/index.php')->only('auth');
$router->get('/profile/edit', 'profile/edit.php')->only('auth');
$router->patch('/profile/edit', 'profile/update.php')->only('auth');

$router->get('/categories', 'categories/index.php');
$router->delete('/categories', 'categories/destroy.php')->only('auth');

$router->get('/categories/create', 'categories/create.php')->only('auth');
$router->post('/categories/create', 'categories/store.php')->only('auth');

$router->get('/category', 'categories/show.php');
$router->get('/category/edit', 'categories/edit.php')->only('auth');
$router->patch('/category/edit', 'categories/update.php')->only('auth');


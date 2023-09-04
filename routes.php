<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');

$router->get('/contact', 'contact/index.php');
$router->post('/contact', 'contact/store.php');

$router->get('/articles', 'articles/index.php')->only('auth');
$router->get('/article', 'articles/show.php');
$router->delete('/article', 'articles/destroy.php');

$router->get('/article/edit', 'articles/edit.php');
$router->patch('/article', 'articles/update.php');

$router->get('/articles/create', 'articles/create.php');
$router->post('/articles', 'articles/store.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/verify', 'registration/verifyAccount/index.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');

$router->get('/reset-password', 'password_reset/create.php')->only('guest');
$router->post('/reset-password', 'password_reset/store.php')->only('guest');

$router->get('/reset-password-token', 'password_reset/show.php')->only('guest');
$router->patch('/reset-password-token', 'password_reset/update.php')->only('guest');

$router->get('/profile', 'profile/index.php')->only('auth');

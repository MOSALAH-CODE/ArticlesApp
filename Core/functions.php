<?php

use Core\App;
use Core\Database;
use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("includes/errors/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}

function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function getCurrentUser($value, $key='email'){
    return App::resolve(Database::class)->get('users', [$key, '=', $value])->first();
}

function getTime(){
    date_default_timezone_set('Europe/Istanbul');
    return date('Y-m-d H:i:s', time());
}

function hasPermission($user, $resource) {
    if ($user->isLoggedIn()) {
        if ($resource === $user->data()['id']) {
            return true; // User is the owner
        }
        if ($user->hasPermission('admin')) {
            return true; // User has 'admin' role
        }
    }

    return false; // User doesn't have permission
}
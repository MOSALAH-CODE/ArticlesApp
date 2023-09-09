<?php

use Core\App;
use Core\Authenticator;
use Core\Cookie;
use Core\Database;
use Core\Redirect;
use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__.'/../';

session_start();

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'Core/functions.php';
require BASE_PATH . 'bootstrap.php';

$router = new \Core\Router();
require BASE_PATH . 'routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return Redirect::to($router->previousUrl());
}

Session::unflash();

$config_remember = require base_path('Core/Config/remember.php');
$config_session = require base_path('Core/Config/sessions.php');

if (Cookie::exists($config_remember['cookie_name']) && !Session::exists($config_session['session_name'])) {
    $token = Cookie::get($config_remember['cookie_name']);
    $hashCheck = App::resolve(Database::class)->getInstance()->get('remember_tokens', ['token', '=', $token])->first();
    if (count($hashCheck)) {
        $user_id = $hashCheck['user_id'];
        // Fetch user data based on user_id
        $user = App::resolve(Database::class)->getInstance()->get('users', ['id', '=', $user_id])->first();

        if ($user) {
            (new Authenticator())->login($user);

            Redirect::to('/');
        }
    }
}

//require base_path('createDB.php');



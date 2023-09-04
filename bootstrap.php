<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind('Core\Database', function () {
    $config = require base_path('Core/Config/database.php');

    return Database::getInstance($config);
});

App::setContainer($container);

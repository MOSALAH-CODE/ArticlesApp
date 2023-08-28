<?php

namespace Core\Middleware;

use Core\Redirect;

class Authenticated
{
    public function handle()
    {
        if (! $_SESSION['user'] ?? false) {
            Redirect::to('/');
        }
    }
}
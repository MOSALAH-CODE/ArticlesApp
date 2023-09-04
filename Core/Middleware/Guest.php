<?php

namespace Core\Middleware;

use Core\Redirect;

class Guest
{
    public function handle()
    {
        if ($_SESSION['user'] ?? false) {
            Redirect::to('/');
        }
    }
}
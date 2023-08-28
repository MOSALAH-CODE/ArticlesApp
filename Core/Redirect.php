<?php

namespace Core;

class Redirect
{
    public static function to($location = null)
    {
        if ($location) {
            if (is_numeric($location)) {
                abort($location);
            }

            header('Location: ' . $location);
            exit();
        }
    }
}
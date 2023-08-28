<?php

use Core\Authenticator;
use Core\Redirect;

(new Authenticator())->logout();

Redirect::to('/');

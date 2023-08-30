<?php

use Core\Session;

view('password_reset/create.view.php', [
    'errors' => Session::get('errors')
]);

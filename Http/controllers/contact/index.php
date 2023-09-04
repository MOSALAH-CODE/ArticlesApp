<?php

use Core\Session;

view("contact/index.view.php", [
    'heading' => 'Contact Us',
    'errors' => Session::get('errors'),
]);
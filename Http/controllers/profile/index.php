<?php

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}


view("profile/index.view.php", [
    'user' => $currentUser
]);
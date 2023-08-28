<?php

namespace Core;

class Authenticator
{
    public function loginAttempt($email, $password, $remember)
    {
        $user = App::resolve(Database::class)->get('users', ['email', '=', $email])->first();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login($user, $remember);

                return true;
            }
        }

        return false;
    }
    public function registerAttempt($email, $password)
    {
        $user = App::resolve(Database::class)->get('users', ['email', '=', $email])->first();
        if ($user) {
            return false;
        } else {
            App::resolve(Database::class)->insert('users', [
                'email'=>$email,
                'password'=>password_hash($password, PASSWORD_BCRYPT)
            ]);

            $user = App::resolve(Database::class)->get('users', ['email', '=', $email])->first();

            (new Authenticator())->login($user);

            return true;
        }
    }

    public function login($user, $remember = false)
    {
        $config = require base_path('config.php');
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        if ($remember) {
            $token = bin2hex(random_bytes(32)); // Generate a random token
            App::resolve(Database::class)->insert('remember_tokens', [
                'user_id' => $user['id'],
                'token' => $token
            ]);

            // Set the token as a cookie
            setcookie($config['remember']['cookie_name'], $token, time() + 3600 * 24 * 30, '/');
        }

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
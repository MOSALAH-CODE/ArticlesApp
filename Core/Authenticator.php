<?php

namespace Core;

class Authenticator
{
    public function loginAttempt($email, $password)
    {
        $user = App::resolve(Database::class)->get('users', ['email', '=', $email])->first();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email
                ]);

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

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
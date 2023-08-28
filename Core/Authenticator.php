<?php

namespace Core;

class Authenticator
{
    private $_config,
            $_user;

    public function __construct()
    {
        $this->_config = require base_path('config.php');;
    }


    public function loginAttempt($email, $password, $remember)
    {
        $this->getUser($email);
        if ($this->_user) {
            if (password_verify($password, $this->_user['password'])) {
                $this->login($this->_user, $remember);

                return true;
            }
        }

        return false;
    }
    public function registerAttempt($email, $password)
    {
        $this->getUser($email);
        if ($this->_user) {
            return false;
        } else {
            App::resolve(Database::class)->insert('users', [
                'email'=>$email,
                'password'=>password_hash($password, PASSWORD_BCRYPT)
            ]);

            $this->getUser($email);

            (new Authenticator())->login($this->_user);

            return true;
        }
    }

    public function getUser($value, $key='email'){
        return $this->_user = App::resolve(Database::class)->get('users', [$key, '=', $value])->first();
    }


    public function login($user, $remember = false)
    {
        Session::put('user', [
            'id' => $user['id']
        ]);


        if ($remember) {
            $token = bin2hex(random_bytes(32)); // Generate a random token
            App::resolve(Database::class)->insert('remember_tokens', [
                'user_id' => $user['id'],
                'token' => $token
            ]);

            // Set the token as a cookie
            Cookie::put($this->_config['remember']['cookie_name'], $token, time() + 3600 * 24 * 30);
        }

        session_regenerate_id(true);
    }

    public function logout()
    {
//        App::resolve(Database::class)->delete('remember_token', ['user_id', '=', $this->_user['id']]);

        Cookie::delete($this->_config['remember']['cookie_name']);
        Session::destroy();
    }
}
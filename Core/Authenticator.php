<?php

namespace Core;

use PhpParser\Node\Expr\New_;

class Authenticator
{
    private $_config,
        $_user;

    public function __construct()
    {
        $this->_config = require base_path('config.php');;
    }

    public function accountVerified($email){
        $this->getUser($email);
        return $this->_user['status'] === 'verified';
    }

    public function loginAttempt($email, $password, $remember)
    {
        if (!$this->accountVerified($email)){
            return -1;
        }
        $this->getUser($email);
        if ($this->_user) {
            if (password_verify($password, $this->_user['password'])) {
                $this->login($this->_user, $remember);
                return true;
            }
        }
        return false;
    }

    public function registerAttempt($email, $password, $name)
    {
        $this->getUser($email);
        if ($this->_user) {
            return false;
        } else {
            App::resolve(Database::class)->insert('users', [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'name' => $name,
                'status' => "not-verified"
            ]);

            $this->getUser($email);

            $token = bin2hex(random_bytes(16));
            $token_hash = hash('sha256', $token);

            date_default_timezone_set('Europe/Istanbul');
            $expiry = date("Y-m-d H:i:s", time() + 30 * 60);

            \Core\App::resolve(\Core\Database::class)->insert('account_verifications',[
                'user_id'=>$this->_user['id'],
                'token'=>$token_hash,
                'expiration'=> $expiry
            ]);

            $mailer = new Mailer();
            $mailer->sendEmail($email, 'Verify Your Email', <<<END
    Hi {$name},
    Click <a href="http://localhost:8888/verify?token=$token">Here</a> 
    to verify your account
    END
            );

            return true;
        }
    }

    public function resetPasswordAttempt($email, $password)
    {
        $this->getUser($email);

        if ($this->_user) {

            App::resolve(Database::class)->update('users', $email, [
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ], 'email');

            App::resolve(Database::class)->delete('password_resets', ['user_id', '=', $this->_user['id']]);

            $this->getUser($email);

//            (new Authenticator())->login($this->_user);
            return true;
        }
        return false;
    }

    public function getUser($value, $key = 'email')
    {
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
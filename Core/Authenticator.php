<?php

namespace Core;

class Authenticator
{
    private $_sessionName,
        $_cookieName,
        $_user;

    public function __construct()
    {
        $config = require base_path('Core/Config/sessions.php');
        $this->_sessionName = $config['session_name'];
        $config = require base_path('Core/Config/remember.php');
        $this->_cookieName = $config['cookie_name'];
    }

    public function loginAttempt($email, $password, $remember)
    {
        if (!$this->accountVerified($email)) {
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

    public function accountVerified($email)
    {
        $this->getUser($email);
        return $this->_user['status'] === 'verified';
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
            Cookie::put($this->_cookieName, $token, time() + 3600 * 24 * 30);
        }

        session_regenerate_id(true);
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
                'status' => "not-verified",
                'group' => 1
            ]);

            $this->getUser($email);

            $token = bin2hex(random_bytes(16));
            $token_hash = hash('sha256', $token);

            date_default_timezone_set('Europe/Istanbul');
            $expiry = date("Y-m-d H:i:s", time() + 30 * 60);

            \Core\App::resolve(\Core\Database::class)->insert('account_verifications', [
                'user_id' => $this->_user['id'],
                'token' => $token_hash,
                'expiration' => $expiry
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

    public function logout()
    {
//        App::resolve(Database::class)->delete('remember_token', ['user_id', '=', $this->_user['id']]);

        Cookie::delete($this->_cookieName);
        Session::destroy();
    }
}
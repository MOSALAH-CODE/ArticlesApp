<?php

namespace Core;

use Exception;

class User {
    private $_db,
        $_data,
        $_sessionName,
        $_cookieName,
        $isLoggedIn;

    public function __construct($user = null) {
        $this->_db = App::resolve(Database::class);
        $config = require base_path('Core/Config/sessions.php');
        $this->_sessionName = $config['session_name'];
        $config = require base_path('Core/Config/remember.php');
        $this->_cookieName = $config['cookie_name'];

        if(!$user) {
            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName)['id'];

                if($this->find($user)) {
                    $this->isLoggedIn = true;
                } else {
                    //Logout
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'email';
            $data = $this->_db->get('users', array($field, '=', $user));

            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function hasPermission($key) {
        $group = $this->_db->get('`groups`', ['id', '=', $this->data()['group']])->first();

        if(!empty($group)) {
            $permissions = json_decode($group['permissions'], true);

            return !empty($permissions[$key]);
        }

        return false;
    }

    public function exists() {
        return !empty($this->_data);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }
}
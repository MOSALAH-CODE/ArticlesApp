<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class RegisterForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['name'], min: 4)) {
            $this->errors['name'] = 'Please provide a full name of at least four characters.';
        }

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($attributes['password'], min: 7)) {
            $this->errors['password'] = 'Please provide a password of at least seven characters.';
        }

        if (!Validator::confirmPassword($attributes['password'], $attributes['confirm_password'])) {
            $this->errors['confirm_password'] = 'Password confirm must match the password';
        }
    }
}
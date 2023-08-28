<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class RegisterForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a password of at least seven characters.';
        }
    }
}
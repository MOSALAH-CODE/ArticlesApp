<?php

namespace Http\Forms;

use Core\Validator;

class ResetPasswordForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['password'], 7)) {
            $this->errors['password'] = 'Please provide a password of at least seven characters.';
        }

        if (!Validator::confirmPassword($attributes['password'], $attributes['confirm_password'])) {
            $this->errors['confirm_password'] = 'Password confirm must match the password';
        }
    }
}
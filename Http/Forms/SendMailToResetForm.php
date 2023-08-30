<?php

namespace Http\Forms;

use Core\Validator;

class SendMailToResetForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }
    }
}
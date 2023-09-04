<?php

namespace Http\Forms;

use Core\Validator;

class ContactForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::string($this->attributes['name'], max: 255)) {
            $this->errors['name'] = 'Please provide a valid name.';
        }

        if (!Validator::email($this->attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::phone($this->attributes['phone-number'])) {
            $this->errors['phone-number'] = 'Please provide a valid 10-digit phone number.';
        }

        if (!Validator::string($this->attributes['message'], 10, 500)) {
            $this->errors['message'] = 'Please provide a valid message between 10 and 500 characters.';
        }
    }
}

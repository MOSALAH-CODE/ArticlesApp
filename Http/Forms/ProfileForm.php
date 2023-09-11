<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Validator;

class ProfileForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['name'], min: 4)) {
            $this->errors['name'] = 'Please provide a full name of at least four characters.';
        }

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::phone($attributes['phone'])){
            $this->errors['phone'] = 'Please provide a valid 10-digit phone number.';
        }
    }

    public function updateProfile($id)
    {
        App::resolve(Database::class)->update('users', $id, [
            'name' => $this->attributes['name'],
            'email' => $this->attributes['email'],
            'phone' => $this->attributes['phone']
        ]);
    }
}

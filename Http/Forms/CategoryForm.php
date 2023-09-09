<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Validator;

class CategoryForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::string($this->attributes['name'], 1, 255)) {
            $this->errors['name'] = 'A category name of 1 to 255 characters is required.';
        }

        if (!Validator::string($this->attributes['description'], 10, 1000)) {
            $this->errors['description'] = 'A description of 10 to 1,000 characters is required.';
        }
    }

    public function createCategory()
    {
        $category = App::resolve(Database::class)->get('categories', ['name', '=', $this->attributes['name']])->first();
        if (empty($category)){
            App::resolve(Database::class)->insert('categories', [
                'name' => $this->attributes['name'],
                'description' => $this->attributes['description'],
            ]);
        }else{
            $this->error('name', 'This category name already found')->throw();
        }

    }


    public function updateCategory($category_id)
    {
        App::resolve(Database::class)->update('categories', $category_id, [
            'name' => $this->attributes['name'],
            'description' => $this->attributes['description'],
        ]);
    }

}

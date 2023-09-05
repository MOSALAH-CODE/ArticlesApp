<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Validator;

class ArticleForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::string($this->attributes['title'], 1, 255)) {
            $this->errors['title'] = 'A title of 1 to 255 characters is required.';
        }

        if (!Validator::string($this->attributes['description'], 10, 1000)) {
            $this->errors['description'] = 'A description of 10 to 1,000 characters is required.';
        }

        if (!Validator::string($this->attributes['content'], 100, 10000)) {
            $this->errors['content'] = 'A content of 100 to 10,000 characters is required.';
        }

        if ($this->attributes['categories'] === 'null') {
            $this->errors['categories'] = 'A category is required.';
        }

        if (!Validator::string($this->attributes['category'], 1, 255) && ($this->attributes['categories'] === 'others')) {
            $this->errors['categories'] = 'A category of 1 to 255 characters is required.';
        }
    }

    public function uploadImage($image)
    {
        // Handle image upload (if provided)
        $imageUrl = ''; // Initialize the image URL
        if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/images/articles/';
            $uploadPath = base_path($uploadDir); // Set the upload directory
            $uploadedFile = $_FILES['image'];
            $imageFileName = uniqid() . '_' . $uploadedFile['name'];
            $targetPath = $uploadPath . $imageFileName;

            // Check if the directory exists, and if not, try to create it
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Create the directory recursively with full permissions
            }

            if (move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
                $imageUrl = $targetPath; // Set the image URL if upload was successful
            } else {
                $this->errors['image'] = 'Failed to upload image.';
            }
        }
        return $imageUrl;
    }

    public function createArticle($author_id, $category_id, $image_url)
    {
        App::resolve(Database::class)->insert('articles', [
            'title' => $this->attributes['title'],
            'description' => $this->attributes['description'],
            'content' => $this->attributes['content'],
            'author_id' => $author_id,
            'category_id' => $category_id,
            'image_url' => $image_url,
            'publication_date' => getTime()
        ]);
    }

    public function updateArticle($article_id, $category_id, $image_url)
    {
        App::resolve(Database::class)->update('articles', $article_id, [
            'title' => $this->attributes['title'],
            'description' => $this->attributes['description'],
            'content' => $this->attributes['content'],
            'category_id' => $category_id,
            'image_url' => $image_url,
            'publication_date' => getTime()
        ]);
    }

    public function setCategory()
    {
        if ($this->attributes['categories'] === 'others') {
            $category = App::resolve(Database::class)->get('categories', ['name', '=', $this->attributes['category']])->first();
            if (empty($category)) {
                if (!isset($this->errors()['category'])) {
                    App::resolve(Database::class)->insert('categories', [
                        'name' => $this->attributes['category']
                    ]);
                    return App::resolve(Database::class)->query('SELECT * FROM `categories` ORDER BY id DESC LIMIT 1')->first()['id'];
                }

            }
            $this->error('category', 'This category already found')->throw();
        }
        return $this->attributes['categories'];

    }
}

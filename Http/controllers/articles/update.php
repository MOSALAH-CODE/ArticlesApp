<?php

use Core\App;
use Core\Database;
use Core\Redirect;
use Core\Validator;

if (\Core\Session::exists('user')) {
    $currentUser = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}

$db = App::resolve(Database::class);

// find the corresponding article
$article = $db->get('articles', ['id', '=', $_POST['id']])->first();


// authorize that the current user can edit the article
authorize($article['author_id'] === $currentUser['id']);

// validate the form
$errors = [];

// Validate title, content, and image (if provided)
if (!Validator::string($_POST['title'], 1, 255)) {
    $errors['title'] = 'A title of 1 to 255 characters is required.';
}

if (!Validator::string($_POST['description'], 10, 1000)) {
    $errors['description'] = 'A description of 10 to 1,000 characters is required.';
}

if (!Validator::string($_POST['content'], 100, 10000)) {
    $errors['content'] = 'A content of 100 to 10,000 characters is required.';
}

if (!Validator::string(\Core\Input::get('category'), 1, 255) && (\Core\Input::get('categories') === 'others')) {
    $errors['categories'] = 'A category of 1 to 255 characters is required.';
}


// Handle image upload (if provided)
$imageUrl = ''; // Initialize the image URL

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
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
        $errors['image'] = 'Failed to upload image.';
    }
}

// if no validation errors, update the record in the articles database table.
if (count($errors)) {
    return view('articles/edit.view.php', [
        'heading' => 'Edit article',
        'errors' => $errors,
        'article' => $article
    ]);
}

$category_id = \Core\Input::get('categories');

if (\Core\Input::get('categories') === 'others'){
    if (!isset($errors['category'])){
        App::resolve(Database::class)->insert('categories', [
            'name'=>\Core\Input::get('category')
        ]);
        $category_id = App::resolve(Database::class)->query('SELECT * FROM `categories` ORDER BY id DESC LIMIT 1')->first()['id'];
    }
}


$publicationDate = date('Y-m-d H:i:s', time());


$db->update('articles', $_POST['id'], [
        'title' => \Core\Input::get('title'),
        'description' => \Core\Input::get('description'),
        'content' => \Core\Input::get('content'),
        'author_id' => $currentUser['id'],
        'category_id' => $category_id,
        'image_url' => $imageUrl, // Insert the image URL
        'publication_date' => $publicationDate
    ]
);

// redirect the user
Redirect::to('/articles');


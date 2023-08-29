<?php
use Core\App;
use Core\Redirect;
use Core\Validator;
use Core\Database;
use Core\Session;

// Check if the user is logged in
if (Session::exists('user')) {
    $currentUser = getCurrentUser(Session::get('user')['id'], 'id'); // Assuming you have a function for getting the current user
}

$db = App::resolve(Database::class);
$errors = [];

// Validate title, content, and image (if provided)
if (!Validator::string($_POST['title'], 1, 255)) {
    $errors['title'] = 'A title of 1 to 255 characters is required.';
}

if (!Validator::string($_POST['description'], 10, 1000)) {
    $errors['content'] = 'A description of 10 to 1,000 characters is required.';
}

if (!Validator::string($_POST['content'], 100, 10000)) {
    $errors['content'] = 'A content of 100 to 10,000 characters is required.';
}


// Handle image upload (if provided)
$imageUrl = ''; // Initialize the image URL
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'path/to/upload/directory/'; // Set the upload directory
    $uploadedFile = $_FILES['image'];
    $imageFileName = uniqid() . '_' . $uploadedFile['name'];
    $targetPath = $uploadDir . $imageFileName;

    if (move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
        $imageUrl = $targetPath; // Set the image URL if upload was successful
    } else {
        $errors['image'] = 'Failed to upload image.';
    }
}

if (!empty($errors)) {
    return view("articles/create.view.php", [
        'heading' => 'Create article',
        'errors' => $errors
    ]);
}

$publicationDate = date('Y-m-d H:i:s', time());

// Insert article data into the database
$db->insert('articles', [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'content' => $_POST['content'],
    'image_url' => $imageUrl, // Insert the image URL
    'author_id' => $currentUser['id'],
    'publication_date' => $publicationDate
]);

Redirect::to('/articles');

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
    $errors['description'] = 'A description of 10 to 1,000 characters is required.';
}

if (!Validator::string($_POST['content'], 100, 10000)) {
    $errors['content'] = 'A content of 100 to 10,000 characters is required.';
}

if (\Core\Input::get('categories') === 'null'){
    $errors['categories'] = 'A category is required.';
}


if (!Validator::string(\Core\Input::get('category'), 1, 255 && \Core\Input::get('categories') === 'others')){
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
} else {
    // Handle other errors, e.g., file size exceeds maximum, file type not allowed, etc.
    switch ($_FILES['image']['error']) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $errors['image'] = 'The uploaded file exceeds the maximum file size limit.';
            break;
        case UPLOAD_ERR_PARTIAL:
            $errors['image'] = 'The uploaded file was only partially uploaded.';
            break;
        case UPLOAD_ERR_NO_FILE:
            $errors['image'] = 'No file was uploaded.';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
        case UPLOAD_ERR_CANT_WRITE:
        case UPLOAD_ERR_EXTENSION:
        default:
            $errors['image'] = 'An error occurred while uploading the file.';
            break;
    }
}


if (!empty($errors)) {
    return view("articles/create.view.php", [
        'heading' => 'Create article',
        'errors' => $errors
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

// Insert article data into the database
$db->insert('articles', [
    'title' => \Core\Input::get('title'),
    'description' => \Core\Input::get('description'),
    'content' => \Core\Input::get('content'),
    'author_id' => $currentUser['id'],
    'category_id' => $category_id,
    'image_url' => $imageUrl, // Insert the image URL
    'publication_date' => $publicationDate
]);

Redirect::to('/articles');

<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<?php
if (\Core\Session::exists('user')){
    $user = getCurrentUser(\Core\Session::get('user')['id'], 'id');
}
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Hello, <?= $user['email'] ?? 'Guest' ?>. Welcome to the home page.</p>
    </div>
</main>

<?php require('partials/footer.php') ?>

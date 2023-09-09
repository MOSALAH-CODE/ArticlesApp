<?php use Core\App;
use Core\Session;

require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<?php
$attributes = Session::get('attributes');
Session::unflash();
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form method="POST" action="/categories/create" enctype="multipart/form-data">
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <div class="mt-1">
                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Enter article title"
                                        value="<?= $attributes['name'] ?? '' ?>"
                                    >

                                    <?php if (isset($errors['name'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['name'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div>
                                <label for="description"
                                       class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea
                                        id="description"
                                        name="description"
                                        rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Write your article description here..."
                                    ><?= $attributes['description'] ?? '' ?></textarea>

                                    <?php if (isset($errors['description'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['description'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>

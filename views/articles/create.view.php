<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<?php
$categories = \Core\App::resolve(\Core\Database::class)->get('categories')->results();
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form method="POST" action="/articles" enctype="multipart/form-data">
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <div class="mt-1">
                                    <input
                                            id="title"
                                            name="title"
                                            type="text"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Enter article title"
                                            value="<?= $_POST['title'] ?? '' ?>"
                                    >

                                    <?php if (isset($errors['title'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['title'] ?></p>
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
                                    ><?= $_POST['description'] ?? '' ?></textarea>

                                    <?php if (isset($errors['description'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['description'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                                <div class="mt-1">
                                    <textarea
                                            id="content"
                                            name="content"
                                            rows="5"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Write your article content here..."
                                    ><?= $_POST['content'] ?? '' ?></textarea>

                                    <?php if (isset($errors['content'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['content'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div>
                                <label for="categories" class="block text-sm font-medium text-gray-700">Category</label>
                                <div class="mt-1 flex">
                                    <select name="categories" id="dropdown" onchange="dropdownOthers()"
                                            class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    >
                                        <option value="null" >Select</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category['id'] ?>"> <?= $category['name'] ?> </option>
                                        <?php endforeach; ?>
                                        <option value="others">Others</option>
                                    </select>
                                    <input
                                            style="display: none"
                                            type="text"
                                            name="category"
                                            id="others-text"
                                            placeholder="Category"
                                            class="ml-2 mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    />
                                </div>
                                <?php if (isset($errors['categories'])) : ?>
                                    <p class="text-red-500 text-xs mt-2"><?= $errors['categories'] ?></p>
                                <?php endif; ?>

                                <?php if (isset($errors['category'])) : ?>
                                    <p class="text-red-500 text-xs mt-2"><?= $errors['category'] ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                <div class="mt-1">
                                    <input
                                            name="image"
                                            class="relative m-0 block min-w-0 flex-auto rounded border border-solid border-gray-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none shadow-sm"
                                            type="file"
                                            id="formFile"
                                    />
                                </div>
                                <?php if (isset($errors['image'])) : ?>
                                    <p class="text-red-500 text-xs mt-2"><?= $errors['image'] ?></p>
                                <?php endif; ?>
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

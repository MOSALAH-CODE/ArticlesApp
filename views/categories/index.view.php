<?php require base_path('views/partials/headWhiteBG.php') ?>
<?php require base_path('views/partials/nav.php');

 if (\Core\Session::exists('error')) {
    $error = \Core\Session::get('error');
    \Core\Session::unflash();
 }
?>

<div class="bg-white py-24 sm:py-8">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mt-16">
            <div class="mx-auto max-w-4xl px-6 lg:px-8">
                <div class="flex justify-between items-center mb-4">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Article Categories</h3>
                        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">List of article categories.</p>
                    </div>
                    <a href="/categories/create" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Create category
                    </a>
                </div>
                <div class="mt-6 border-t border-gray-100">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="text-left text-sm font-medium leading-6 text-gray-900">Category Name</th>
                            <th class="text-left text-sm font-medium leading-6 text-gray-900">Description</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($categories as $category) : ?>
                            <tr>
                                <td class="text-left text-sm leading-6 text-gray-700">
                                    <a href="category?id=<?= $category['id'] ?>">
                                        <?= $category['name'] ?>
                                    </a>
                                    <?php if (isset($error) && ($category['id'] == $error['categoryId'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $error['message'] ?></p>
                                    <?php endif; ?>
                                </td>
                                <td class="text-left text-sm leading-6 text-gray-700">
                                    <a href="category?id=<?= $category['id'] ?>">
                                        <?= $category['description'] ?>
                                    </a></td>
                                <?php if ($hasPermission) : ?>
                                    <td class="text-center text-indigo-600 hover:text-indigo-500">
                                        <a href="category/edit?id=<?= $category['id'] ?>">Edit</a>
                                        <button type="button" class="text-red-500 mr-auto ml-3" onclick="document.querySelector('#delete-<?=$category['id']?>').submit()">Delete</button>
                                    </td>
                                    <form id="delete-<?=$category['id']?>" class="hidden" method="POST" action="/categories">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                    </form>

                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require base_path('views/partials/footer.php') ?>

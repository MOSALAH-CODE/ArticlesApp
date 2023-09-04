<?php require base_path('views/partials/headWhiteBG.php') ?>
<?php require base_path('views/partials/nav.php');
$category = \Core\App::resolve(\Core\Database::class)->get('categories', ['id', '=', $article['category_id']])->first();
?>

<div class="relative isolate overflow-hidden bg-white px-6 mt-10 lg:overflow-visible lg:px-0">

    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-1 lg:items-start lg:gap-y-10">
        <div class="lg:col-span-2 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:grid lg:w-full lg:max-w-7xl lg:grid-cols-1 lg:gap-x-8 lg:px-8">
            <div class="lg:pr-4">
                <div>
                    <a href="category?id=<?= $category['id'] ?>" class="text-base font-semibold leading-7 text-indigo-600"><?= $category['name'] ?></a>
                    <div class="flex justify-between items-center mb-4">
                        <div class="mx-auto max-w-2xl lg:mx-0">
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"><?= $article['title'] ?></h2>
                        </div>
                        <a href="/article/edit?id=<?= $article['id'] ?>"
                           class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Edit article
                        </a>
                    </div>
                    <p class="mt-6 text-xl leading-8 text-gray-700"><?= $article['description'] ?></p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 lg:col-start-1 lg:row-start-2 lg:mx-auto lg:grid lg:w-full lg:max-w-7xl lg:grid-cols-1 lg:gap-x-8 lg:px-8">
            <div class="lg:pr-4">
                <div class="text-base leading-7 text-gray-700">
                    <p><?= $article['content'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require base_path('views/partials/footer.php') ?>

<?php require base_path('views/partials/headWhiteBG.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div class="bg-white py-24 sm:py-8">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <?php if ($hasPermission) : ?>
            <div class="flex justify-between items-center mb-4">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"><?= $category['name'] ?></h2>
                    <p class="mt-2 text-lg leading-8 text-gray-600"><?= $category['description'] ?></p>
                </div>
                <a href="/category/edit?id=<?= $category['id'] ?>" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Edit category
                </a>
            </div>

        <?php endif; ?>
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <?php foreach ($articles as $article) : ?>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="flex items-center gap-x-4 text-xs">
                        <time datetime="<?= $article['publication_date'] ?>" class="text-gray-500"><?= $article['publication_date'] ?></time>
                        <a href="category?id=<?=$article['category_id']?>"
                           class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"><?= \Core\App::resolve(\Core\Database::class)->get('categories', ['id', '=', $article['category_id']])->first()['name'] ?></a>
                    </div>
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <a href="article?id=<?= $article['id'] ?>">
                                <span class="absolute inset-0"></span>
                                <?= $article['title'] ?>
                            </a>
                        </h3>
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600"><?= $article['description'] ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require base_path('views/partials/footer.php') ?>

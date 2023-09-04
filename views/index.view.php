<?php require('partials/headWhiteBG.php') ?>
<?php require('partials/nav.php') ?>

<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the blog</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Learn how to grow your business with our expert advice.</p>
        </div>
        <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
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
                    <div class="relative mt-8 flex items-center gap-x-4">
                        <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                             alt="" class="h-10 w-10 rounded-full bg-gray-50">
                        <div class="text-sm leading-6">
                            <p class="font-semibold text-gray-900">
                                <a href="author?id=<?=$article['author_id']?>">
                                    <span class="absolute inset-0"></span>
                                    <?= \Core\App::resolve(\Core\Database::class)->get('users', ['id', '=', $article['author_id']])->first()['name'] ?>
                                </a>
                            </p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!--<div class="relative isolate overflow-hidden  px-6 py-24 sm:py-8 lg:overflow-visible lg:px-0">-->
<!---->
<!--    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-2 lg:items-start lg:gap-y-10">-->
<!--        <div class="lg:col-span-2 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:grid lg:w-full lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8">-->
<!--            --><?php //foreach ($articles as $article) : ?>
<!--                <div style="margin-top: 4em" class="lg:pr-4">-->
<!--                    <div class="bg-white p-6 rounded-lg shadow-md">-->
<!--                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">--><?php //= $article['title'] ?><!--</h1>-->
<!--                        <p class="mt-6 text-xl leading-8 text-gray-700">--><?php //= $article['description'] ?><!--</p>-->
<!--                        <p class="mt-2 text-base font-semibold leading-7 text-indigo-600">Publication-->
<!--                                                                                          Date: --><?php //= $article['publication_date'] ?><!--</p>-->
<!--                        <div class="lg:mt-6 lg:text-right lg:pl-4">-->
<!--                            <a href="article?id= --><?php //=$article['id']?><!--" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Read more</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            --><?php //endforeach; ?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->




<?php require('partials/footer.php') ?>



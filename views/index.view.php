<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<?php

?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Hello, <?= $user['email'] ?? 'Guest' ?>. Welcome to the home page.</p>
    </div>
</main>


<div class="relative isolate overflow-hidden  px-6 py-24 sm:py-8 lg:overflow-visible lg:px-0">

    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-2 lg:items-start lg:gap-y-10">
        <div class="lg:col-span-2 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:grid lg:w-full lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8">
            <?php foreach ($articles as $article) : ?>
                <div style="margin-top: 4em" class="lg:pr-4">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"><?= $article['title'] ?></h1>
                        <p class="mt-6 text-xl leading-8 text-gray-700"><?= $article['description'] ?></p>
                        <p class="mt-2 text-base font-semibold leading-7 text-indigo-600">Publication
                                                                                          Date: <?= $article['publication_date'] ?></p>
                        <div class="lg:mt-6 lg:text-right lg:pl-4">
                            <a href="article?id= <?=$article['id']?>" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Read more</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>


<?php require('partials/footer.php') ?>



<?php require('partials/headWhiteBG.php') ?>
<?php require('partials/nav.php') ?>

<style>
    /* Adjust the dropdown menu position */
    .dropdown-menu {
        position: absolute;
        top: 100%; /* Position the menu below the button */
        right: 0; /* Position the menu to the right */
        z-index: 1; /* Ensure the menu is above other elements */
        opacity: 0.8; /* Set the opacity to your desired value */
    }

</style>

<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the blog</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Learn how to grow your business with our expert advice.</p>
        </div>
        <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <?php $x = 0; ?>
            <?php foreach ($articles as $article) : ?>
                <article class="flex max-w-xl flex-col justify-between">
                    <div class="flex justify-between gap-x-4 text-xs">
                        <div class="flex items-center gap-x-4 text-xs">
                            <time datetime="<?= $article['publication_date'] ?>" class="text-gray-500"><?= $article['publication_date'] ?></time>
                            <a href="category?id=<?=$article['category_id']?>"
                               class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"><?= \Core\App::resolve(\Core\Database::class)->get('categories', ['id', '=', $article['category_id']])->first()['name'] ?></a>
                        </div>
                        <div >
                            <?php if ($hasPermissions[$x]) : ?>
                                <div class="relative group" id="<?php echo 'dropdown_' . $x ?>">
                                    <div class="dropdown inline-block relative">
                                        <button class="bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center" onmouseover="showDropdown(<?php echo $x ?>)" onmouseleave="hideDropdown(<?php echo $x ?>)">
                                            <!-- Remove the text "Actions" and add an SVG icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 transform group-hover:rotate-180 transition-transform duration-200 ease-in-out mr-1">
                                                <path fill-rule="evenodd" d="M2 3a1 1 0 011-1h14a1 1 0 110 2H3a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                <path fill-rule="evenodd" d="M2 8a1 1 0 011-1h14a1 1 0 110 2H3a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                <path fill-rule="evenodd" d="M2 13a1 1 0 011-1h14a1 1 0 110 2H3a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <!-- Add an icon here (e.g., Font Awesome or any other icon library) -->
                                            <!-- For example, a pencil icon -->
                                            <i class="fas fa-pencil"></i>
                                        </button>
                                        <ul class="dropdown-menu hidden text-gray-700 pt-1" onmouseleave="hideDropdown(<?php echo $x ?>)" onmouseover="showDropdown(<?php echo $x ?>)">
                                            <li><a class="rounded-t bg-green-200 hover:bg-green-300 py-2 px-4 block whitespace-no-wrap text-black" href="/article/edit?id=<?= $article['id'] ?>">Edit</a></li>
                                            <li><button type="button" class="rounded-b bg-red-200 hover:bg-red-300 py-2 px-4 block whitespace-no-wrap text-black" onclick="document.querySelector('#delete-form-<?= $article['id'] ?>').submit()">Delete</button></li>
                                        </ul>
                                    </div>
                                </div>

                                <form id="delete-form-<?= $article['id'] ?>" class="hidden" method="POST" action="/">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                </form>
                            <?php endif; ?>
                        </div>
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
                <?php $x++; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require('partials/footer.php') ?>



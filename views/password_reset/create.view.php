<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php')?>



<main>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                     alt="Your Company">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Reset your password!</h2>
            </div>

            <form class="mt-8 space-y-6" method="POST">
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <?php if ($loggedIn) : ?>
                            <input id="email"
                                   name="email"
                                   type="email"
                                   autocomplete="email"
                                   class="relative block w-full appearance-none rounded-none rounded-t-md rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                   placeholder="Email address"
                                   readonly
                                   value="<?= $user['email'] ?>">
                        <?php endif;?>
                        <?php if (!$loggedIn) : ?>
                            <input id="email"
                                   name="email"
                                   type="email"
                                   autocomplete="email"
                                   class="relative block w-full appearance-none rounded-none rounded-t-md rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                   placeholder="Email address"
                                   value="<?= old('email') ?>">
                        <?php endif;?>
                    </div>
                </div>
                <div>
                    <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Send
                    </button>
                </div>

                <ul>
                    <?php if (isset($errors['email'])) : ?>
                        <li class="text-red-500 text-xs mt-2"><?= $errors['email'] ?></li>
                    <?php endif; ?>
                </ul>
            </form>
            <p class="mt-10 text-center text-sm text-gray-500">
                Not yet a member?
                <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register now</a>
            </p>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>



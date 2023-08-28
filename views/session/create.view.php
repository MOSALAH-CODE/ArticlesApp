<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<style>
    .custom-checkbox {
        /* Default styles */
        width: 1rem;
        height: 1rem;
        background-color: #F3F4F6;
        border: 1px solid #D1D5DB;
        border-radius: 0.25rem;

        /* Focus styles */
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .custom-checkbox:focus {
        border-color: #1C64F2;
        outline: none;
        box-shadow: 0 0 0 3px rgba(28, 100, 242, 0.25);
    }

    /* Dark mode styles */
    .dark .custom-checkbox {
        background-color: #4B5563;
        border-color: #374151;
    }

    .dark .custom-checkbox:focus {
        box-shadow: 0 0 0 3px rgba(28, 100, 242, 0.25);
    }

</style>

<main>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                     alt="Your Company">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Log In!</h2>
            </div>

            <form class="mt-8 space-y-6" action="/session" method="POST">
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email"
                               name="email"
                               type="email"
                               autocomplete="email"
                               required
                               class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Email address"
                               value="<?= old('email') ?>">
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password"
                               name="password"
                               type="password"
                               autocomplete="current-password"
                               required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Password">
                    </div>
                </div>

                <div class="flex items-center mb-4">
                    <input id="remember" name="remember" type="checkbox" class="custom-checkbox">
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-black-300">Remember me</label>
                </div>

                <div>
                    <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Log In
                    </button>
                </div>

                <ul>
                    <?php if (isset($errors['email'])) : ?>
                        <li class="text-red-500 text-xs mt-2"><?= $errors['email'] ?></li>
                    <?php endif; ?>

                    <?php if (isset($errors['password'])) : ?>
                        <li class="text-red-500 text-xs mt-2"><?= $errors['password'] ?></li>
                    <?php endif; ?>
                </ul>
            </form>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>

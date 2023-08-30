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
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="custom-checkbox">
                        <label for="remember" class="ml-2 font-medium leading-6 text-gray-900 hover:text-indigo-500 text-sm">Remember me</label>
                    </div>
                    <div class="text-sm">
                        <a href="/reset-password" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                </div>


                <!--                <div class="flex h-6 items-center">-->
<!--                     Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
<!--                    <span-->
<!--                            id="switch-span"-->
<!--                            class="translate-x-4 h-4 w-4 cursor-pointer transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out"-->
<!--                            role="switch"-->
<!--                            aria-checked="false"-->
<!--                            aria-labelledby="switch-button-label"-->
<!--                    ></span>-->
<!--                    <input-->
<!--                            id="switch-button"-->
<!--                            type="button"-->
<!--                            class="bg-gray-200 flex h-5 w-8 flex-none cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"-->
<!--                            role="switch"-->
<!--                            aria-checked="false"-->
<!--                            aria-labelledby="switch-button-label"-->
<!--                    > Enabled: "translate-x-3.5", Not Enabled: "translate-x-0" -->
<!---->
<!--                </div>-->

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
            <p class="mt-10 text-center text-sm text-gray-500">
                Not yet a member?
                <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register now</a>
            </p>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>



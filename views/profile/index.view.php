<?php require base_path('views/partials/headWhiteBG.php') ?>
<?php require base_path('views/partials/nav.php') ?>


<div class="mt-16">
    <div class="mx-auto max-w-4xl px-6 lg:px-8">
        <div class="flex justify-between items-center mb-4">
            <div class="px-4 sm:px-0">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Applicant Information</h3>
                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and application.</p>
            </div>
            <a href="/profile/edit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Edit profile
            </a>
        </div>
        <div>
            <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-1 sm:mt-0"><?= $user['name'] ?></dd>
                    </div>
                    <form method="post">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-1 sm:mt-0"><?= $user['email'] ?></dd>
                        </div>
                    </form>

                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">

                        <div class="mt-1 sm:mt-0 sm:col-span-1">
                            <a href="/reset-password"
                               class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >Change password</a>
                        </div>
                    </div>
                </dl>
            </div>

        </div>
    </div>
</div>


<?php require base_path('views/partials/footer.php') ?>

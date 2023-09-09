<?php require base_path('views/partials/headWhiteBG.php') ?>
<?php require base_path('views/partials/nav.php') ?>


<div class="mt-16">
    <div class="mx-auto max-w-4xl px-6 lg:px-8">
        <div class="flex justify-between items-center mb-4">
            <div class="px-4 sm:px-0">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Update profile information</h3>
                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and application.</p>
            </div>
        </div>
        <form method="post" action="/profile/edit">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-0">
                        <div>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
                            <?php if (isset($errors['name'])) : ?>
                                <p class="text-red-500 text-xs mt-2"><?= $errors['name'] ?></p>
                            <?php endif; ?>
                        </div>

                        <label for="name" hidden="hidden" >Name</label>
                        <input name="name" id="name" class="relative block w-full appearance-none rounded-none rounded-t-md rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               value="<?= $user['name'] ?>" placeholder="Enter your full name">
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-0">
                        <div>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
                            <?php if (isset($errors['email'])) : ?>
                                <p class="text-red-500 text-xs mt-2"><?= $errors['email'] ?></p>
                            <?php endif; ?>
                        </div>

                        <label for="email" hidden="hidden" >Name</label>
                        <input name="email" id="email" class="relative block w-full appearance-none rounded-none rounded-t-md rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               value="<?= $user['email'] ?>" placeholder="Enter your email">
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-0">

                        <div class="mt-1 sm:mt-0 sm:col-span-1 flex justify-end">
                            <button type="submit"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Update
                            </button>
                        </div>
                    </div>
                </dl>
            </div>


        </form>
    </div>
</div>


<?php require base_path('views/partials/footer.php') ?>

<?php


use Core\App;
use Core\Database;
use Core\Redirect;

$user = new \Core\User();

authorize($user->hasPermission('admin'));

if ($user->hasPermission('admin')) {
    $categoryId = $_POST['id'];

    $hasAssociatedArticles = App::resolve(Database::class)->get('articles', ['category_id', '=', $categoryId])->count();

    if ($hasAssociatedArticles) {
        \Core\Session::flash('error', [
            'categoryId' => $categoryId,
            'message' => 'This category has associated articles and cannot be deleted.']);
    } else {
        App::resolve(Database::class)->delete('categories', ['id', '=', $categoryId]);
    }
}

Redirect::to('/categories');
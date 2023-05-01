<?php declare(strict_types=1);

use App\UI\Http\Site\Page\Blog\GetMyPostsController;
use App\UI\Http\Site\Page\Blog\GetSinglePostController;

/** @var \Illuminate\Routing\Router $router */
$router
    ->get(GetMyPostsController::ROUTE . DIRECTORY_SEPARATOR . '{slug}', GetSinglePostController::class)
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('blog.post');

$router->get(GetMyPostsController::ROUTE, GetMyPostsController::class)->name('blog');

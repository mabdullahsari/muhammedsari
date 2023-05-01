<?php declare(strict_types=1);

use App\UserInterface\Http\Site\Page\Blog\ViewBlogController;
use App\UserInterface\Http\Site\Page\Blog\ReadBlogPostController;

/** @var \Illuminate\Routing\Router $router */
$router
    ->get(ViewBlogController::ROUTE . DIRECTORY_SEPARATOR . '{slug}', ReadBlogPostController::class)
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('blog.post');

$router->get(ViewBlogController::ROUTE, ViewBlogController::class)->name('blog');

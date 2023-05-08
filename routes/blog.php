<?php declare(strict_types=1);

use App\UserInterface\Http\Site\Page\Blog\ViewBlogController;
use App\UserInterface\Http\Site\Page\Blog\ReadBlogPostController;

/** @var \Illuminate\Routing\Router $router */
$router
    ->get('{slug}', ReadBlogPostController::class)
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('blog.post');

$router->get(DIRECTORY_SEPARATOR, ViewBlogController::class)->name('blog');

<?php declare(strict_types=1);

use App\UserInterface\Http\Site\Page\OpenGraph\PreviewBlogPostController;

/** @var \Illuminate\Routing\Router $router */
$router
    ->get('open-graph/blog/{slug}.png', PreviewBlogPostController::class)
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('og');

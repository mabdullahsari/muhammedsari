<?php declare(strict_types=1);

use App\Http\Site\OpenGraph\PreviewBlogPostController;
use App\Http\Site\OpenGraph\PreviewTagController;

/** @var \Illuminate\Routing\Router $router */
$router
    ->get('open-graph/blog/{slug}.png', PreviewBlogPostController::class)
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('og.post');

$router
    ->get('open-graph/tags/{slug}.png', PreviewTagController::class)
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('og.tag');

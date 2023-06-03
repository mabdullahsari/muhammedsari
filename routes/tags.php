<?php declare(strict_types=1);

use App\Http\Site\Page\Tags\ViewTagController;
use App\Http\Site\Page\Tags\ViewTagsController;

/** @var \Illuminate\Routing\Router $router */
$router
    ->get(ViewTagsController::ROUTE . DIRECTORY_SEPARATOR . '{slug}', ViewTagController::class)
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('tag');

$router->get(ViewTagsController::ROUTE, ViewTagsController::class)->name('tags');

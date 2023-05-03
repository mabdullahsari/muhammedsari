<?php declare(strict_types=1);

use App\UserInterface\Http\Site\Page\Tags\TagController;
use App\UserInterface\Http\Site\Page\Tags\ViewTagsController;

/** @var \Illuminate\Routing\Router $router */
$router
    ->get(ViewTagsController::ROUTE . DIRECTORY_SEPARATOR . '{slug}', [TagController::class, 'show'])
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('tags.show');

$router->get(ViewTagsController::ROUTE, ViewTagsController::class)->name('tags');

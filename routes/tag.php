<?php declare(strict_types=1);

use App\UI\Http\Site\Page\Tag\TagController;

/** @var \Illuminate\Routing\Router $router */
$router
    ->get('tags/{slug}', [TagController::class, 'show'])
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('tags.show');

$router->get('tags', [TagController::class, 'index'])->name('tags.index');

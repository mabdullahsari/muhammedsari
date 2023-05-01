<?php declare(strict_types=1);

use App\UserInterface\Http\Site\Page\About\AboutController;

/** @var \Illuminate\Routing\Router $router */
$router->get(AboutController::INDEX, [AboutController::class, 'index'])->name('about');

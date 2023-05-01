<?php declare(strict_types=1);

use App\UserInterface\Http\Site\Page\Home\HomeController;

/** @var \Illuminate\Routing\Router $router */
$router->get(HomeController::INDEX, [HomeController::class, 'index'])->name('home');

<?php declare(strict_types=1);

use App\Health\CheckHealthController;

/** @var \Illuminate\Routing\Router $router */
$router->get(CheckHealthController::ROUTE, CheckHealthController::class)->name('health');

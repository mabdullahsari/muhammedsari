<?php declare(strict_types=1);

use App\Http\Health\CheckHealthController;

/** @var \Illuminate\Routing\Router $router */
$router->get(CheckHealthController::ROUTE, CheckHealthController::class)->name('health');

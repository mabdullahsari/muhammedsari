<?php declare(strict_types=1);

use App\UserInterface\Http\Site\Page\Contact\ContactController;

/** @var \Illuminate\Routing\Router $router */
$router->get(ContactController::INDEX, [ContactController::class, 'index'])->name('contact');

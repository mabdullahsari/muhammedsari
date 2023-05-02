<?php declare(strict_types=1);

use App\UserInterface\Http\Site\Page\Contact\SubmitContactFormController;
use App\UserInterface\Http\Site\Page\Contact\ViewContactFormController;
use Spatie\Honeypot\ProtectAgainstSpam;

/** @var \Illuminate\Routing\Router $router */
$router->get(ViewContactFormController::ROUTE, ViewContactFormController::class)->name('contact');
$router->post(ViewContactFormController::ROUTE, SubmitContactFormController::class)->middleware(ProtectAgainstSpam::class);

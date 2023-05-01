<?php declare(strict_types=1);

namespace Contacting;

use Contacting\Contract\ContactMuhammed;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

final class ContactingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->resolving(Dispatcher::class, $this->registerHandlers(...));
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
    }

    private function registerHandlers(Dispatcher $commands): void
    {
        $commands->map([ContactMuhammed::class => ContactMuhammedHandler::class]);
    }

    private function registerPolicies(Gate $access): void
    {
        $access->policy(ContactForm::class, ContactFormPolicy::class);
    }
}

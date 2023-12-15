<?php declare(strict_types=1);

namespace App\Http\Site\Page\Contact;

use App\Http\Site\View\Navigation;
use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class ContactServiceProvider extends AggregateServiceProvider
{
    public const string NAME = 'Contact';

    protected $providers = [
        \Contacting\ContactingServiceProvider::class,
        \Notifying\NotifyingServiceProvider::class,
        \PreventingSpam\PreventingSpamServiceProvider::class,
        \Spatie\Honeypot\HoneypotServiceProvider::class,
    ];

    public function boot(Router $router): void
    {
        Navigation::register(self::NAME, ViewContactFormController::ROUTE);

        if (! $this->app->routesAreCached()) {
            $router->group([], $this->app->basePath('routes/contact.php'));
        }
    }
}

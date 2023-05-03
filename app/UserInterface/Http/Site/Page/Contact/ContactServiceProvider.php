<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Contact;

use App\UserInterface\Http\Site\View\Navigation;
use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class ContactServiceProvider extends AggregateServiceProvider
{
    public const NAME = 'Contact';

    protected $providers = [
        \Contacting\ContactingServiceProvider::class,
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

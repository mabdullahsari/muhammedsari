<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Contact;

use App\UserInterface\Http\Site\View\Navigation;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class ContactServiceProvider extends ServiceProvider
{
    public const NAME = 'Contact';

    public function boot(Router $router): void
    {
        Navigation::register(self::NAME, ContactController::INDEX, 2);

        if (! $this->app->routesAreCached()) {
            $router->group([], $this->app->basePath('routes/contact.php'));
        }
    }
}

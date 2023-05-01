<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Contact;

use App\UI\Http\Site\View\Components\Navigation;
use HtmlBeautifier\Contract\BeautifyHtml;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class ContactServiceProvider extends ServiceProvider
{
    public const NAME = 'Contact';

    public function boot(Router $router): void
    {
        Navigation::register(self::NAME, ContactController::INDEX, 2);

        if (! $this->app->routesAreCached()) {
            $router->middleware(BeautifyHtml::MIDDLEWARE)->group($this->app->basePath('routes/contact.php'));
        }
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, self::NAME);
    }
}

<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Contact;

use App\UI\Http\Site\View\Components\Navigation;
use Illuminate\Support\ServiceProvider;

final class ContactServiceProvider extends ServiceProvider
{
    public const NAME = 'Contact';

    public function boot(): void
    {
        Navigation::register(self::NAME, ContactController::ROUTE, 2);
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, self::NAME);
    }
}

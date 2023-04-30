<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\About;

use App\UI\Http\Site\View\Components\Navigation;
use Illuminate\Support\ServiceProvider;

final class AboutServiceProvider extends ServiceProvider
{
    public const NAME = 'About';

    public function boot(): void
    {
        Navigation::register(self::NAME, AboutController::ROUTE, 0);
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, self::NAME);
    }
}

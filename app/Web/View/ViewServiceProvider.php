<?php declare(strict_types=1);

namespace App\Web\View;

use App\Web\View\Composers\MeComposer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

final class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->resolving('view', $this->registerComposers(...));
    }

    private function registerComposers(Factory $view): void
    {
        $view->composer('components.page', MeComposer::class);
    }
}

<?php declare(strict_types=1);

namespace App\Web\View;

use App\Web\View\Components\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

final class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->resolving('blade.compiler', $this->registerComponents(...));
    }

    private function registerComponents(BladeCompiler $blade): void
    {
        $blade->component(Page::class, 'page');
    }
}

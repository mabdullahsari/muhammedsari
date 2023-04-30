<?php declare(strict_types=1);

namespace App\UI\Http\Site\View;

use App\UI\Http\Site\View\Components\Navigation;
use App\UI\Http\Site\View\Components\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

final class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerNavigation();
        $this->registerPage();
    }

    private function registerNavigation(): void
    {
        $this->app->when(Navigation::class)->needs('$home')->giveConfig('app.url');
        $this->app->when(Navigation::class)->needs('$name')->giveConfig('app.name');
        $this->app->resolving('blade.compiler', static function (BladeCompiler $blade) {
            $blade->component(Navigation::class, Navigation::NAME);
        });
    }

    private function registerPage(): void
    {
        $this->app->resolving('blade.compiler', static function (BladeCompiler $blade) {
            $blade->component(Page::class, Page::NAME);
        });
    }
}

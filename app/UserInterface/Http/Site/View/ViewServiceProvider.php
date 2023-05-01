<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\View;

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
        $this->app->when(Page::class)->needs('$description')->giveConfig('feed.feeds.main.description');
        $this->app->when(Page::class)->needs('$suffix')->giveConfig('app.name');
        $this->app->resolving('blade.compiler', static function (BladeCompiler $blade) {
            $blade->component(Page::class, Page::NAME);
        });
    }
}

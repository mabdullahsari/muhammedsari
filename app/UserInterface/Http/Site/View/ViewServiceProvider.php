<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\View;

use Illuminate\Http\Request;
use Illuminate\Support\AggregateServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

final class ViewServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \BladeUI\Icons\BladeIconsServiceProvider::class,
    ];

    public function register(): void
    {
        parent::register();

        $this->registerFooter();
        $this->registerNavigation();
        $this->registerPage();
    }

    private function registerFooter(): void
    {
        $this->app->when(Footer::class)->needs('$name')->giveConfig('app.name');
        $this->app->resolving('blade.compiler', static function (BladeCompiler $blade) {
            $blade->component(Footer::class, Footer::NAME);
        });
    }

    private function registerNavigation(): void
    {
        $this->app->when(Navigation::class)->needs('$home')->giveConfig('app.url');
        $this->app->when(Navigation::class)->needs('$name')->giveConfig('app.name');
        $this->app->when(Navigation::class)->needs('$request')->give(fn () => $this->app->make(Request::class)->path());
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

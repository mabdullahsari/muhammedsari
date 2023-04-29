<?php declare(strict_types=1);

namespace App\UI\Http\Site\Tag;

use Illuminate\Support\ServiceProvider;

final class TagServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'Tag');
    }
}

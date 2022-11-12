<?php declare(strict_types=1);

namespace App\Web\Tags;

use Illuminate\Support\ServiceProvider;

final class TagsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'Tags');
    }
}

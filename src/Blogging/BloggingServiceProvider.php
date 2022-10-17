<?php declare(strict_types=1);

namespace Domain\Blogging;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\AggregateServiceProvider;

final class BloggingServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        AuthServiceProvider::class,
    ];

    public function boot(): void
    {
        Relation::enforceMorphMap(['post' => Post::class]);
    }
}

<?php declare(strict_types=1);

namespace Domain\Core;

use Illuminate\Support\AggregateServiceProvider;

final class CoreServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Carbon\Laravel\ServiceProvider::class,

        \Domain\Blogging\BloggingServiceProvider::class,
        \Domain\Identity\IdentityServiceProvider::class,
    ];
}

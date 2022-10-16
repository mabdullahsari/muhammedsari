<?php declare(strict_types=1);

namespace Domain\Core;

use Illuminate\Support\AggregateServiceProvider;

final class CoreServiceProvider extends AggregateServiceProvider
{
    /** @var array<int, class-string> */
    protected $providers = [
        \Carbon\Laravel\ServiceProvider::class,
        \Domain\Identity\IdentityServiceProvider::class,
    ];
}

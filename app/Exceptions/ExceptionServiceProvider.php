<?php declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Support\AggregateServiceProvider;

final class ExceptionServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Sentry\Laravel\ServiceProvider::class,
    ];
}

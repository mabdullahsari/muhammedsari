<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Support\AggregateServiceProvider;

final class ConsoleServiceProvider extends AggregateServiceProvider
{
    /** @var array<int, class-string> */
    protected $providers = [
        \Termwind\Laravel\TermwindServiceProvider::class,
    ];
}

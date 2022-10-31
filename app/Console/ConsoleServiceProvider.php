<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Support\AggregateServiceProvider;

final class ConsoleServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Termwind\Laravel\TermwindServiceProvider::class,
        \Laravel\Tinker\TinkerServiceProvider::class,
    ];

    public function boot(): void
    {
        $this->commands([
            ProcessSchedulerTickCommand::class,
            PublishBlogPostCommand::class,
        ]);
    }
}

<?php declare(strict_types=1);

namespace App\CommandBus;

use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\AggregateServiceProvider;

final class CommandBusServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \PreventingSpam\PreventingSpamServiceProvider::class,
    ];

    private array $pipes = [
        \PreventingSpam\Contract\CommandBus::MIDDLEWARE,
        UseDatabaseTransactions::class,
    ];

    public function register(): void
    {
        parent::register();

        $this->app->resolving(Dispatcher::class, $this->registerPipeline(...));
    }

    private function registerPipeline(Dispatcher $commands): void
    {
        $commands->pipeThrough($this->pipes);
    }
}

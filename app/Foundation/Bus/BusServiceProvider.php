<?php declare(strict_types=1);

namespace App\Foundation\Bus;

use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

final class BusServiceProvider extends ServiceProvider
{
    private array $pipes = [
        UseDatabaseTransactions::class,
    ];

    public function register(): void
    {
        $this->app->resolving(Dispatcher::class, $this->registerPipeline(...));
    }

    private function registerPipeline(Dispatcher $bus): void
    {
        $bus->pipeThrough($this->pipes);
    }
}

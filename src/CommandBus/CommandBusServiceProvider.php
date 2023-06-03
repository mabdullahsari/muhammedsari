<?php declare(strict_types=1);

namespace CommandBus;

use CommandBus\Contract\Pipeline;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

final class CommandBusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->afterResolving(Dispatcher::class, $this->registerPipeline(...));
    }

    private function registerPipeline(Dispatcher $commands): void
    {
        $commands->pipeThrough(Pipeline::get());
    }
}

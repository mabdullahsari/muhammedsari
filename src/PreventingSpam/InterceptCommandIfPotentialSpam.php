<?php declare(strict_types=1);

namespace PreventingSpam;

use Closure;
use Illuminate\Contracts\Bus\Dispatcher;
use PreventingSpam\Contract\PotentialSpam;

final readonly class InterceptCommandIfPotentialSpam
{
    public function __construct(private Dispatcher $commands) {}

    public function handle(object $command, Closure $next): mixed
    {
        if ($command instanceof PotentialSpam) {
            return $this->commands->dispatch(new DetectSpam($command));
        }

        return $next($command);
    }
}

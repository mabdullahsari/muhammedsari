<?php declare(strict_types=1);

namespace PreventingSpam;

use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use PreventingSpam\Contract\PotentialSpam;

final readonly class DetectSpam implements ShouldQueue
{
    public function __construct(private PotentialSpam $command) {}

    public function handle(DetectorResolver $detectors, Dispatcher $commands): void
    {
        $detection = $detectors->resolve($this->command)->detect($this->command);

        if ($detection->isSpam) {
            $commands->dispatch(new QuarantineDetectedSpam($detection->method, $this->command));
        } else {
            $commands->getCommandHandler($this->command)->handle($this->command);
        }
    }
}

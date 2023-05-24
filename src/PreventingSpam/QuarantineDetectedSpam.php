<?php declare(strict_types=1);

namespace PreventingSpam;

use Illuminate\Contracts\Queue\ShouldQueue;
use PreventingSpam\Contract\PotentialSpam;
use Psr\Log\LoggerInterface;

final readonly class QuarantineDetectedSpam implements ShouldQueue
{
    private const WARNING = <<<TEXT
    Spam was detected:

    [method] %s [message] %s
    TEXT;

    public function __construct(
        private string $detection,
        private PotentialSpam $spam,
    ) {}

    public function handle(LoggerInterface $logger): void
    {
        $logger->alert(sprintf(self::WARNING, $this->detection, json_encode($this->spam)));
    }
}

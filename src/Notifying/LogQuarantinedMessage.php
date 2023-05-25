<?php declare(strict_types=1);

namespace Notifying;

use DateTimeImmutable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Psr\Log\LoggerInterface;

final readonly class LogQuarantinedMessage implements ShouldQueue
{
    use Dispatchable;

    private const TEMPLATE = <<<TEXT
    Spam was detected:

    when: %s
    info: %s
    TEXT;


    public function __construct(
        public string $message,
        public DateTimeImmutable $quarantinedAt,
    ) {}

    public function handle(LoggerInterface $logger): void
    {
        $logger->alert(
            sprintf(
                self::TEMPLATE,
                $this->quarantinedAt->format(DateTimeImmutable::RFC3339),
                $this->message,
            )
        );
    }
}

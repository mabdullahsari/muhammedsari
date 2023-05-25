<?php declare(strict_types=1);

namespace PreventingSpam\Contract;

use DateTimeImmutable;

final readonly class MessageQuarantined
{
    public function __construct(
        public string $message,
        public DateTimeImmutable $quarantinedAt,
    ) {}
}

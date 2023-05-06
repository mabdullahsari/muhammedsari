<?php declare(strict_types=1);

namespace Contacting\Contract;

final readonly class MuhammedContacted
{
    public function __construct(
        public string $email,
        public string $message,
        public string $name,
    ) {}
}

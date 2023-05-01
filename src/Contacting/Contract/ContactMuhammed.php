<?php declare(strict_types=1);

namespace Contacting\Contract;

final readonly class ContactMuhammed
{
    public function __construct(
        public string $email,
        public string $ipAddress,
        public string $message,
        public string $name,
    ) {}
}

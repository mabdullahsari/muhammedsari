<?php declare(strict_types=1);

namespace Contacting\Contract;

use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class ContactMuhammed implements ShouldQueue
{
    public function __construct(
        public string $email,
        public string $ipAddress,
        public string $message,
        public string $name,
    ) {}
}

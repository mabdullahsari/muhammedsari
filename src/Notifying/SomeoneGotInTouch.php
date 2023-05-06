<?php declare(strict_types=1);

namespace Notifying;

final readonly class SomeoneGotInTouch
{
    public function __construct(
        public string $email,
        public string $message,
        public string $name,
    ) {}
}

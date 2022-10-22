<?php declare(strict_types=1);

namespace Domain\Blogging\ValueObjects;

use Dive\Utils\Makeable;

final class Body
{
    use Makeable;

    private function __construct(
        private readonly string $value,
    ) {}

    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

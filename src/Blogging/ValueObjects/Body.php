<?php declare(strict_types=1);

namespace Domain\Blogging\ValueObjects;

use Dive\Utils\Makeable;
use JsonSerializable;
use Stringable;

final class Body implements JsonSerializable, Stringable
{
    use Makeable;

    private function __construct(
        private readonly string $value,
    ) {}

    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

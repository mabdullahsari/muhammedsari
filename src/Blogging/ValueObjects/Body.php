<?php declare(strict_types=1);

namespace Domain\Blogging\ValueObjects;

use Stringable;

final class Body implements Stringable
{
    private function __construct(
        private readonly string $value,
    ) {}

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

<?php declare(strict_types=1);

namespace Blogging;

use Stringable;

final readonly class Body implements Stringable
{
    private function __construct(
        private string $value,
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

<?php declare(strict_types=1);

namespace Domain\Blogging;

use InvalidArgumentException;

final class PostId
{
    private readonly int $value;

    private function __construct(int $value)
    {
        if ($value < 1) {
            throw new InvalidArgumentException("{$value} is not a valid post identifier.");
        }

        $this->value = $value;
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }

    public function asInt(): int
    {
        return $this->value;
    }
}

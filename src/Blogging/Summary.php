<?php declare(strict_types=1);

namespace Domain\Blogging;

use Stringable;
use UnexpectedValueException;

final class Summary implements Stringable
{
    public const MAX_LENGTH = 100;

    private readonly string $value;

    private function __construct(string $value)
    {
        if (mb_strlen($value) > self::MAX_LENGTH) {
            throw new UnexpectedValueException("'{$value}' is too long.");
        }

        $this->value = $value;
    }

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

<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Stringable;
use UnexpectedValueException;

final class Title implements Stringable
{
    private readonly string $value;

    private function __construct(string $value)
    {
        if (empty($value)) {
            throw new UnexpectedValueException('A title cannot be empty.');
        }

        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return "“{$this->value}”";
    }
}

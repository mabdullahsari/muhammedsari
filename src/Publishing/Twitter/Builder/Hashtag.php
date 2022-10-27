<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter\Builder;

use Stringable;
use UnexpectedValueException;

final class Hashtag implements Stringable
{
    private readonly string $value;

    private function __construct(string $value)
    {
        if (empty($value)) {
            throw new UnexpectedValueException('A hashtag cannot be empty.');
        }

        if (str_contains($value, ' ')) {
            throw new UnexpectedValueException('A hashtag cannot contain whitespaces.');
        }

        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return "#{$this->value}";
    }
}

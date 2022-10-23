<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter\Builder;

use Dive\Utils\Makeable;
use UnexpectedValueException;

final class Hashtag
{
    use Makeable;

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

    public function __toString(): string
    {
        return "#{$this->value}";
    }
}

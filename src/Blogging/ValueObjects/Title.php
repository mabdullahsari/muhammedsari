<?php declare(strict_types=1);

namespace Domain\Blogging\ValueObjects;

use Dive\Utils\Makeable;
use UnexpectedValueException;

final class Title
{
    use Makeable;

    private readonly string $value;

    private function __construct(string $value)
    {
        if (empty($value)) {
            throw new UnexpectedValueException('Title cannot be empty.');
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

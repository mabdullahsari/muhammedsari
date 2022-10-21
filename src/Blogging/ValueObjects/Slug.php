<?php declare(strict_types=1);

namespace Domain\Blogging\ValueObjects;

use Dive\Utils\Makeable;
use JsonSerializable;
use Stringable;
use UnexpectedValueException;

final class Slug implements JsonSerializable, Stringable
{
    use Makeable;

    public const PATTERN = '[a-z0-9]+(?:-[a-z0-9]+)*';
    public const REGEX = '/^' . self::PATTERN . '$/';

    private readonly string $value;

    private function __construct(string $value)
    {
        if (! preg_match(self::REGEX, $value)) {
            throw new UnexpectedValueException("'{$value}' is not a valid slug.");
        }

        $this->value = $value;
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
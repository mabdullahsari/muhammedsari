<?php declare(strict_types=1);

namespace Domain\Blogging;

use Dive\Utils\Makeable;
use Illuminate\Contracts\Database\Eloquent\Castable;
use JsonSerializable;
use Stringable;
use UnexpectedValueException;

final class Slug implements Castable, JsonSerializable, Stringable
{
    use Makeable;

    const PATTERN = '[a-z0-9]+(?:-[a-z0-9]+)*';

    private readonly string $value;

    private function __construct(string $value)
    {
        if (! preg_match('/^' . self::PATTERN . '$/', $value)) {
            throw new UnexpectedValueException("'{$value}' is not a valid slug.");
        }

        $this->value = $value;
    }

    public static function castUsing(array $arguments): string
    {
        return AsSlug::class;
    }

    public static function rule(): SlugRule
    {
        return SlugRule::make();
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

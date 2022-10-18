<?php declare(strict_types=1);

namespace Domain\Blogging;

use Dive\Utils\Makeable;
use Illuminate\Contracts\Database\Eloquent\Castable;
use JsonSerializable;
use Stringable;
use UnexpectedValueException;

final class Summary implements Castable, JsonSerializable, Stringable
{
    use Makeable;

    public const MAX_LENGTH = 100;

    private readonly string $value;

    private function __construct(string $value)
    {
        if (mb_strlen($value) > self::MAX_LENGTH) {
            throw new UnexpectedValueException("'{$value}' is too long.");
        }

        $this->value = $value;
    }

    public static function castUsing(array $arguments): string
    {
        return AsSummary::class;
    }

    public static function rule(): SummaryRule
    {
        return SummaryRule::make();
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

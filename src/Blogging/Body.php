<?php declare(strict_types=1);

namespace Domain\Blogging;

use Dive\Utils\Makeable;
use Illuminate\Contracts\Database\Eloquent\Castable;
use JsonSerializable;
use Stringable;

final class Body implements Castable, JsonSerializable, Stringable
{
    use Makeable;

    private function __construct(
        private readonly string $value,
    ) {}

    public static function castUsing(array $arguments): string
    {
        return AsBody::class;
    }

    public function isEmpty(): bool
    {
        return empty($this->value);
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

<?php declare(strict_types=1);

namespace Domain\Blogging\Models\Casts;

use Domain\Blogging\ValueObjects\Summary;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

final class AsSummary implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): Summary
    {
        if ($value instanceof Summary) {
            return $value;
        }

        if (is_null($value)) {
            $value = '';
        }

        if (is_string($value)) {
            return Summary::make($value);
        }

        throw new InvalidArgumentException("The given value cannot be cast to an instance of Summary.");
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        return (string) $this->get($model, $key, $value, $attributes);
    }
}

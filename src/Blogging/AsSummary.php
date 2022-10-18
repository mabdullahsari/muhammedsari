<?php declare(strict_types=1);

namespace Domain\Blogging;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

final class AsSummary implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?Summary
    {
        if (is_null($value)) {
            return $value;
        }

        if ($value instanceof Summary) {
            return $value;
        }

        if (is_string($value)) {
            return Summary::make($value);
        }

        throw new InvalidArgumentException("The given value cannot be cast to an instance of Summary.");
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        $value = $this->get($model, $key, $value, $attributes);

        return $value instanceof Summary ? (string) $value : $value;
    }
}

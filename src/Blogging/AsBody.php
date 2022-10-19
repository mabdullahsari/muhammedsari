<?php declare(strict_types=1);

namespace Domain\Blogging;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

final class AsBody implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): Body
    {
        if ($value instanceof Body) {
            return $value;
        }

        if (is_null($value)) {
            $value = '';
        }

        if (is_string($value)) {
            return Body::make($value);
        }

        throw new InvalidArgumentException("The given value cannot be cast to an instance of Body.");
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        return (string) $this->get($model, $key, $value, $attributes);
    }
}

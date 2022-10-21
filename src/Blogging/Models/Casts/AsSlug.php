<?php declare(strict_types=1);

namespace Domain\Blogging\Models\Casts;

use Domain\Blogging\ValueObjects\Slug;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

final class AsSlug implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): Slug
    {
        if ($value instanceof Slug) {
            return $value;
        }

        if (is_string($value)) {
            return Slug::make($value);
        }

        throw new InvalidArgumentException("The given value cannot be cast to an instance of Slug.");
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        return (string) $this->get($model, $key, $value, $attributes);
    }
}

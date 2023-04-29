<?php declare(strict_types=1);

namespace Blogging;

use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;
use InvalidArgumentException;

final readonly class ConvertNullToEmptyString implements CastsInboundAttributes
{
    public function set($model, string $key, $value, array $attributes): string
    {
        if (is_null($value)) {
            return '';
        }

        if (is_string($value)) {
            return $value;
        }

        throw new InvalidArgumentException('You must provide null or a string.');
    }
}

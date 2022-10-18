<?php declare(strict_types=1);

namespace Domain\Blogging;

use Dive\Utils\Makeable;
use Illuminate\Contracts\Validation\InvokableRule;
use UnexpectedValueException;

final class SummaryRule implements InvokableRule
{
    use Makeable;

    public function __invoke($attribute, $value, $fail): void
    {
        try {
            Summary::make($value);
        } catch (UnexpectedValueException) {
            $fail('validation.max.string')->translate(['max' => Summary::MAX_LENGTH]);
        }
    }
}

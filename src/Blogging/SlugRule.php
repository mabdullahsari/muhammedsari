<?php declare(strict_types=1);

namespace Domain\Blogging;

use Dive\Utils\Makeable;
use Illuminate\Contracts\Validation\InvokableRule;
use UnexpectedValueException;

final class SlugRule implements InvokableRule
{
    use Makeable;

    public function __invoke($attribute, $value, $fail): void
    {
        try {
            Slug::make($value);
        } catch (UnexpectedValueException) {
            $fail('validation.regex')->translate();
        }
    }
}

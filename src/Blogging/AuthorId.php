<?php declare(strict_types=1);

namespace Domain\Blogging;

use Webmozart\Assert\Assert;

final class AuthorId
{
    private const MIN = 1;

    private readonly int $value;

    private function __construct(int $value)
    {
        Assert::greaterThanEq($value, self::MIN);

        $this->value = $value;
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }

    public function asInt(): int
    {
        return $this->value;
    }
}

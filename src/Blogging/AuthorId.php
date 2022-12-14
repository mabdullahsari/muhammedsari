<?php declare(strict_types=1);

namespace Core\Blogging;

use Webmozart\Assert\Assert;

final readonly class AuthorId
{
    private const MIN = 1;

    private int $value;

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

<?php declare(strict_types=1);

namespace EstimatingReadingTime\Contract;

use Stringable;
use Webmozart\Assert\Assert;

final readonly class Time implements Stringable
{
    private const MIN_TIME = 1;

    private function __construct(public int $value)
    {
        Assert::greaterThanEq($this->value, self::MIN_TIME);
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}

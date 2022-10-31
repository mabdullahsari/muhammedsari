<?php declare(strict_types=1);

namespace Domain\Blogging;

use Stringable;
use Webmozart\Assert\Assert;

final class Summary implements Stringable
{
    public const MAX_LENGTH = 100;

    private readonly string $value;

    private function __construct(string $value)
    {
        Assert::maxLength($value, self::MAX_LENGTH);

        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

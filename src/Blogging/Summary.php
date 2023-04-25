<?php declare(strict_types=1);

namespace Blogging;

use Stringable;
use Webmozart\Assert\Assert;

final readonly class Summary implements Stringable
{
    public const MAX_LENGTH = 100;

    private string $value;

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

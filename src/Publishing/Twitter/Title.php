<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Stringable;
use Webmozart\Assert\Assert;

final readonly class Title implements Stringable
{
    private string $value;

    private function __construct(string $value)
    {
        Assert::stringNotEmpty($value);

        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return "“{$this->value}”";
    }
}

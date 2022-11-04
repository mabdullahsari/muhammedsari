<?php declare(strict_types=1);

namespace Domain\Blogging;

use Stringable;
use Webmozart\Assert\Assert;

final readonly class Slug implements Stringable
{
    public const PATTERN = '[a-z0-9]+(?:-[a-z0-9]+)*';
    public const REGEX = '/^' . self::PATTERN . '$/';

    private string $value;

    private function __construct(string $value)
    {
        Assert::regex($value, self::REGEX);

        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

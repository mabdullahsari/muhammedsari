<?php declare(strict_types=1);

namespace Core\Publishing\Twitter;

use Stringable;
use Webmozart\Assert\Assert;

final readonly class Tweet implements Stringable
{
    public const MAX_LENGTH = 280;

    private string $message;

    private function __construct(string $message)
    {
        Assert::stringNotEmpty($message);
        Assert::maxLength($message, self::MAX_LENGTH);

        $this->message = $message;
    }

    public static function fromString(string $message): self
    {
        return new self($message);
    }

    public function __toString(): string
    {
        return $this->message;
    }
}

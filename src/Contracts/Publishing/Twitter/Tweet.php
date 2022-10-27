<?php declare(strict_types=1);

namespace Domain\Contracts\Publishing\Twitter;

use Stringable;
use UnexpectedValueException;

final class Tweet implements Stringable
{
    public const MAX_LENGTH = 280;

    private readonly string $message;

    private function __construct(string $message)
    {
        if (empty($message)) {
            throw new UnexpectedValueException('A tweet cannot be empty.');
        }

        if (mb_strlen($message) > self::MAX_LENGTH) {
            throw new UnexpectedValueException('The message is too long to fit in a tweet.');
        }

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

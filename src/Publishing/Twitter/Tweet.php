<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Dive\Utils\Makeable;
use Illuminate\Contracts\Support\Arrayable;
use UnexpectedValueException;

final class Tweet implements Arrayable
{
    use Makeable;

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

    public function toArray(): array
    {
        return ['text' => $this->message];
    }
}

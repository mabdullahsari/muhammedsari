<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Stringable;

final readonly class TweetUrl implements Stringable
{
    private const BASE_URL = 'https://twitter.com/mabdullahsari/status';
    private const ONE_TWO_THREE = '123';

    private function __construct(private string $value) {}

    public static function fromId(string $id): self
    {
        return new self(self::BASE_URL . DIRECTORY_SEPARATOR . $id);
    }

    public static function oneTwoThree(): self
    {
        return self::fromId(self::ONE_TWO_THREE);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

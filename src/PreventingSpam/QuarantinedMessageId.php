<?php declare(strict_types=1);

namespace PreventingSpam;

use Webmozart\Assert\Assert;

final readonly class QuarantinedMessageId
{
    private const MINIMAL_VALUE = 0;

    private int $id;

    private function __construct(int $id)
    {
        Assert::greaterThan($id, self::MINIMAL_VALUE);

        $this->id = $id;
    }

    public static function fromInt(int $id): self
    {
        return new self($id);
    }

    public function asInt(): int
    {
        return $this->id;
    }
}

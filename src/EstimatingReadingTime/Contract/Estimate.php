<?php declare(strict_types=1);

namespace EstimatingReadingTime\Contract;

use Stringable;

final readonly class Estimate implements Stringable
{
    private function __construct(public Unit $unit, public Time $time) {}

    public static function minutes(Time $time): self
    {
        return new self(Unit::Minutes, $time);
    }

    public function __toString(): string
    {
        return "{$this->time} {$this->unit->value}";
    }
}

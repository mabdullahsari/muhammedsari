<?php declare(strict_types=1);

namespace PreventingSpam;

abstract readonly class Analyzer
{
    public const NAME = 'analyzer';

    abstract public function analyze(string $subject): Result;

    protected function normalize(string $value): string
    {
        return mb_strtolower(trim($value));
    }
}

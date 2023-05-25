<?php declare(strict_types=1);

namespace PreventingSpam;

abstract readonly class Analyzer
{
    abstract public function analyze(string $subject): Result;

    abstract public function method(): DetectionMethod;

    protected function normalize(string $value): string
    {
        return mb_strtolower(trim($value));
    }
}

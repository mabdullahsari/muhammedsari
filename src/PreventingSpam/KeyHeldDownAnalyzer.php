<?php declare(strict_types=1);

namespace PreventingSpam;

final readonly class KeyHeldDownAnalyzer extends Analyzer
{
    public function analyze(string $subject): Result
    {
        if (preg_match('/(.)\\1{4,}/', $subject)) {
            return Result::spam($this);
        }

        return Result::clean($this);
    }

    public function method(): DetectionMethod
    {
        return DetectionMethod::KeyHeldDown;
    }
}

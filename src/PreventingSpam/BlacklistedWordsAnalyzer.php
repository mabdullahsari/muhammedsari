<?php declare(strict_types=1);

namespace PreventingSpam;

final readonly class BlacklistedWordsAnalyzer extends Analyzer
{
    private const array DICTIONARY = ['adolf', 'hitler'];

    public function analyze(string $subject): Result
    {
        $subject = $this->normalize($subject);

        foreach (self::DICTIONARY as $word) {
            if (str_contains($subject, $word)) {
                return Result::spam($this);
            }
        }

        return Result::clean($this);
    }

    public function method(): DetectionMethod
    {
        return DetectionMethod::BlacklistedEmails;
    }
}

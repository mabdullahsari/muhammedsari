<?php declare(strict_types=1);

namespace PreventingSpam;

final readonly class BlacklistedEmailsAnalyzer extends Analyzer
{
    private const array DICTIONARY = ['demo@demo.com', 'demo@dive.be'];

    public function analyze(string $subject): Result
    {
        $subject = $this->normalize($subject);

        if (in_array($subject, self::DICTIONARY)) {
            return Result::spam($this);
        }

        return Result::clean($this);
    }

    public function method(): DetectionMethod
    {
        return DetectionMethod::BlacklistedEmails;
    }
}

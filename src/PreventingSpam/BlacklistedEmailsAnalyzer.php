<?php declare(strict_types=1);

namespace PreventingSpam;

final readonly class BlacklistedEmailsAnalyzer extends Analyzer
{
    public const NAME = 'email_blacklist';
    private const DICTIONARY = ['demo@demo.com', 'demo@dive.be'];

    public function analyze(string $subject): Result
    {
        $subject = $this->normalize($subject);

        if (in_array($subject, self::DICTIONARY)) {
            return Result::spam($this);
        }

        return Result::clean($this);
    }
}

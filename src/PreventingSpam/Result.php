<?php declare(strict_types=1);

namespace PreventingSpam;

final readonly class Result
{
    private function __construct(public string $analyzer, public bool $isSpam) {}

    public static function clean(Analyzer $analyzer): self
    {
        return new self($analyzer::NAME, false);
    }

    public static function spam(Analyzer $analyzer): self
    {
        return new self($analyzer::NAME, true);
    }

    public function and(Analyzer $analyzer, string $subject): self
    {
        if ($this->isSpam) {
            return $this;
        }

        return $analyzer->analyze($subject);
    }
}

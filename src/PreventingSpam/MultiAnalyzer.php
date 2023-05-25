<?php declare(strict_types=1);

namespace PreventingSpam;

final readonly class MultiAnalyzer extends Analyzer
{
    public const NAME = 'chain';

    private function __construct(private array $analyzers) {}

    public static function chain(Analyzer ...$analyzers): self
    {
        return new self($analyzers);
    }

    public function analyze(string $subject): Result
    {
        foreach ($this->analyzers as $analyzer) {
            $result = $analyzer->analyze($subject);

            if ($result->isSpam) {
                return $result;
            }
        }

        return Result::clean($this);
    }

    public function method(): DetectionMethod
    {
        return DetectionMethod::Multi;
    }
}

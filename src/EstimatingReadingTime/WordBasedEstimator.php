<?php declare(strict_types=1);

namespace EstimatingReadingTime;

use EstimatingReadingTime\Contract\Estimate;
use EstimatingReadingTime\Contract\Estimator;
use EstimatingReadingTime\Contract\Time;

final readonly class WordBasedEstimator implements Estimator
{
    private const WORDS_PER_MINUTE = 165;

    public function estimate(string $text): Estimate
    {
        $estimation = (int) ceil(str_word_count($text) / self::WORDS_PER_MINUTE);
        $estimation = Time::fromInt($estimation);

        return Estimate::minutes($estimation);
    }
}

<?php declare(strict_types=1);

namespace EstimatingReadingTime\Contract;

interface Estimator
{
    public function estimate(string $text): Estimate;
}

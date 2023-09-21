<?php declare(strict_types=1);

namespace EstimatingReadingTime;

use Illuminate\Support\ServiceProvider;
use EstimatingReadingTime\Contract\Estimator;

final class EstimatingReadingTimeServiceProvider extends ServiceProvider
{
    public array $singletons = [Estimator::class => WordBasedEstimator::class];
}

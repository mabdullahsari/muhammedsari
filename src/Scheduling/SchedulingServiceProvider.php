<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Domain\Scheduling\Clock\Clock;
use Domain\Scheduling\Clock\NativeClock;
use Illuminate\Support\ServiceProvider;

final class SchedulingServiceProvider extends ServiceProvider
{
    public array $singletons = [
        Clock::class => NativeClock::class,
    ];
}

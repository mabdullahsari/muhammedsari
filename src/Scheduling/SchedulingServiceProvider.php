<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Illuminate\Support\ServiceProvider;

final class SchedulingServiceProvider extends ServiceProvider
{
    public array $singletons = [
        Clock::class => NativeClock::class,
    ];
}

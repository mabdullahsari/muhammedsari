<?php declare(strict_types=1);

namespace Clock;

use Clock\Contract\Clock;
use Illuminate\Support\ServiceProvider;
use Psr\Clock\ClockInterface;

final class ClockServiceProvider extends ServiceProvider
{
    public array $singletons = [
        Clock::class => NativeClock::class,
        ClockInterface::class => NativeClock::class,
    ];

    public function register(): void
    {
        $this->app->when(NativeClock::class)->needs('$timezone')->giveConfig('app.timezone');
    }
}

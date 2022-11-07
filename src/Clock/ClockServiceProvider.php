<?php declare(strict_types=1);

namespace Core\Clock;

use Core\Contracts\Clock\Clock;
use Illuminate\Support\ServiceProvider;

final class ClockServiceProvider extends ServiceProvider
{
    public array $singletons = [Clock::class => NativeClock::class];

    public function register(): void
    {
        $this->app->when(NativeClock::class)->needs('$timezone')->giveConfig('app.timezone');
    }
}

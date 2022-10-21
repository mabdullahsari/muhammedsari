<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Domain\Scheduling\Access\EntryPolicy;
use Domain\Scheduling\Clock\Clock;
use Domain\Scheduling\Clock\NativeClock;
use Domain\Scheduling\Models\Entry;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider;

final class SchedulingServiceProvider extends ServiceProvider
{
    public array $singletons = [
        Clock::class => NativeClock::class,
        EntryRepository::class => DatabaseEntryRepository::class,
        Scheduler::class => Scheduler::class,
    ];

    public function register(): void
    {
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
    }

    private function registerPolicies(Gate $access): void
    {
        $access->policy(Entry::class, EntryPolicy::class);
    }
}

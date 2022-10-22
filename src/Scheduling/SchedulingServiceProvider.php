<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Domain\Blogging\Contracts\Events\PostWasDeleted;
use Domain\Scheduling\Access\EntryPolicy;
use Domain\Scheduling\Listeners\RemoveScheduledEntry;
use Domain\Scheduling\Models\Entry;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

final class SchedulingServiceProvider extends ServiceProvider
{
    public array $singletons = [
        EntryRepository::class => SQLiteEntryRepository::class,
        Scheduler::class => Scheduler::class,
    ];

    public function boot(Dispatcher $events): void
    {
        $events->listen(PostWasDeleted::class, RemoveScheduledEntry::class);
    }

    public function register(): void
    {
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
    }

    private function registerPolicies(Gate $access): void
    {
        $access->policy(Entry::class, EntryPolicy::class);
    }
}

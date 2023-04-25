<?php declare(strict_types=1);

namespace Scheduling;

use Contract\Blogging\Event\PostWasDeleted;
use Contract\Blogging\Event\PostWasPublished;
use Contract\Scheduling\Scheduler;
use Scheduling\Models\Publication;
use Scheduling\Models\PublicationPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

final class SchedulingServiceProvider extends ServiceProvider
{
    public array $singletons = [
        PublicationRepository::class => SQLitePublicationRepository::class,
        Scheduler::class => CrontabDrivenScheduler::class,
    ];

    public function boot(Dispatcher $events): void
    {
        $events->listen(PostWasDeleted::class, RemoveScheduledPublication::class);
        $events->listen(PostWasPublished::class, RemoveScheduledPublication::class);
    }

    public function register(): void
    {
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
    }

    private function registerPolicies(Gate $access): void
    {
        $access->policy(Publication::class, PublicationPolicy::class);
    }
}

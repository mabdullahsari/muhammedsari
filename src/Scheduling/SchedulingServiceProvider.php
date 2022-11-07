<?php declare(strict_types=1);

namespace Core\Scheduling;

use Core\Contracts\Blogging\Events\PostWasDeleted;
use Core\Contracts\Blogging\Events\PostWasPublished;
use Core\Contracts\Scheduling\Scheduler;
use Core\Scheduling\Models\Publication;
use Core\Scheduling\Models\PublicationPolicy;
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

<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Domain\Contracts\Blogging\Events\PostWasDeleted;
use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Contracts\Scheduling\Scheduler;
use Domain\Scheduling\Access\PublicationPolicy;
use Domain\Scheduling\Listeners\CancelScheduledPublication;
use Domain\Scheduling\Models\Publication;
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
        $events->listen(PostWasDeleted::class, CancelScheduledPublication::class);
        $events->listen(PostWasPublished::class, CancelScheduledPublication::class);
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

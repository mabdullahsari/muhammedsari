<?php declare(strict_types=1);

namespace Scheduling;

use Blogging\Contract\PostDeleted;
use Blogging\Contract\PostPublished;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Scheduling\Contract\Scheduler;
use Scheduling\Models\Publication;
use Scheduling\Models\PublicationPolicy;

final class SchedulingServiceProvider extends ServiceProvider
{
    public array $singletons = [
        PublicationRepository::class => SQLitePublicationRepository::class,
        Scheduler::class => CrontabDrivenScheduler::class,
    ];

    public function boot(Dispatcher $events): void
    {
        $events->listen(PostDeleted::class, RemoveScheduledPublication::class);
        $events->listen(PostPublished::class, RemoveScheduledPublication::class);
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

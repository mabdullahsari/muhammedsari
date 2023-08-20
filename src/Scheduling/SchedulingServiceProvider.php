<?php declare(strict_types=1);

namespace Scheduling;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Scheduling\Contract\Scheduler;
use Scheduling\Integration\BloggingSubscriber;

final class SchedulingServiceProvider extends ServiceProvider
{
    public array $singletons = [Scheduler::class => CrontabScheduler::class];

    public function boot(Dispatcher $events): void
    {
        $events->subscribe(BloggingSubscriber::class);
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

<?php declare(strict_types=1);

namespace Queue;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Queue\QueueManager;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Connectors\RedisConnector;
use Laravel\Horizon\Contracts\JobRepository;
use Laravel\Horizon\Contracts\TagRepository;
use Laravel\Horizon\Events\JobPushed;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\Listeners\StoreJob;
use Laravel\Horizon\Listeners\StoreMonitoredTags;
use Laravel\Horizon\Repositories\RedisJobRepository;
use Laravel\Horizon\Repositories\RedisTagRepository;

final class QueueServiceProvider extends ServiceProvider
{
    public array $singletons = [
        JobRepository::class => RedisJobRepository::class,
        TagRepository::class => RedisTagRepository::class,
    ];

    public function boot(Dispatcher $events): void
    {
        $events->listen(JobPushed::class, StoreJob::class);
        $events->listen(JobPushed::class, StoreMonitoredTags::class);
    }

    public function register(): void
    {
        $this->configure();
        $this->registerQueueConnectors();
    }

    private function configure(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../vendor/laravel/horizon/config/horizon.php', 'horizon');

        Horizon::use('default');
    }

    private function registerQueueConnectors(): void
    {
        $this->callAfterResolving(QueueManager::class, function ($manager) {
            $manager->addConnector('redis', function () {
                return new RedisConnector($this->app['redis']);
            });
        });
    }
}

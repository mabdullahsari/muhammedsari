<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Publishing\Twitter\Integration\BloggingSubscriber;

final class TwitterServiceProvider extends ServiceProvider
{
    public array $singletons = [Twitter::class => TwitterManager::class];

    public function boot(Dispatcher $events): void
    {
        $events->subscribe(BloggingSubscriber::class);
    }
}

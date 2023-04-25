<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Blogging\Contract\PostPublished;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

final class TwitterServiceProvider extends ServiceProvider
{
    public array $singletons = [
        PublishedPostProvider::class => SQLitePublishedPostProvider::class,
        Twitter::class => TwitterManager::class,
    ];

    public function boot(Dispatcher $events): void
    {
        $events->listen(PostPublished::class, SendTweetAboutNewPost::class);
    }
}

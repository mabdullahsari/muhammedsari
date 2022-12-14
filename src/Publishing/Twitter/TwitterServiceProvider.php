<?php declare(strict_types=1);

namespace Core\Publishing\Twitter;

use Core\Contract\Blogging\Event\PostWasPublished;
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
        $events->listen(PostWasPublished::class, SendTweetAboutNewPost::class);
    }
}

<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Contracts\Blogging\Events\PostWasPublished;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

final class TwitterServiceProvider extends ServiceProvider
{
    public array $singletons = [
        PostProvider::class => SQLitePostProvider::class,
        Twitter::class => TwitterManager::class,
    ];

    public function boot(Dispatcher $events): void
    {
        $events->listen(PostWasPublished::class, SendTweetAboutNewPost::class);
    }
}

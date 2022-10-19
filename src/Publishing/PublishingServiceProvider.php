<?php declare(strict_types=1);

namespace Domain\Publishing;

use Domain\Publishing\RSS\DatabaseFeedRepository;
use Domain\Publishing\RSS\FeedRepository;
use Domain\Publishing\Twitter\Twitter;
use Domain\Publishing\Twitter\TwitterManager;
use Illuminate\Support\ServiceProvider;

final class PublishingServiceProvider extends ServiceProvider
{
    public array $singletons = [
        FeedRepository::class => DatabaseFeedRepository::class,
        Twitter::class => TwitterManager::class,
    ];
}

<?php declare(strict_types=1);

namespace Domain\Publishing;

use Domain\Publishing\RSS\DatabaseFeedRepository;
use Domain\Publishing\RSS\FeedRepository;
use Illuminate\Support\ServiceProvider;

final class PublishingServiceProvider extends ServiceProvider
{
    public array $singletons = [
        FeedRepository::class => DatabaseFeedRepository::class,
    ];
}

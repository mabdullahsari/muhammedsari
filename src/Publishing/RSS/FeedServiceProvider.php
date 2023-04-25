<?php declare(strict_types=1);

namespace Publishing\RSS;

use Contract\Publishing\RSS\FeedProvider;
use Illuminate\Support\ServiceProvider;

final class FeedServiceProvider extends ServiceProvider
{
    public array $singletons = [FeedProvider::class => SQLiteFeedProvider::class];
}

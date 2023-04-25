<?php declare(strict_types=1);

namespace Publishing\RSS;

use Illuminate\Support\ServiceProvider;
use Publishing\Contract\FeedProvider;

final class FeedServiceProvider extends ServiceProvider
{
    public array $singletons = [FeedProvider::class => SQLiteFeedProvider::class];
}

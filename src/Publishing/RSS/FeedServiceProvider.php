<?php declare(strict_types=1);

namespace Domain\Publishing\RSS;

use Domain\Contracts\Publishing\RSS\FeedProvider;
use Illuminate\Support\ServiceProvider;

final class FeedServiceProvider extends ServiceProvider
{
    public array $singletons = [FeedProvider::class => SQLiteFeedProvider::class];
}

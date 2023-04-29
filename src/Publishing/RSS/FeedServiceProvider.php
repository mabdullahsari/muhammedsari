<?php declare(strict_types=1);

namespace Publishing\RSS;

use Illuminate\Support\AggregateServiceProvider;
use Publishing\Contract\FeedProvider;

final class FeedServiceProvider extends AggregateServiceProvider
{
    public array $singletons = [FeedProvider::class => SQLiteFeedProvider::class];

    protected $providers = [
        \Spatie\Feed\FeedServiceProvider::class,
    ];
}

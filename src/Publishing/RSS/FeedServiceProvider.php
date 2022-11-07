<?php declare(strict_types=1);

namespace Core\Publishing\RSS;

use Core\Contracts\Publishing\RSS\FeedProvider;
use Illuminate\Support\ServiceProvider;

final class FeedServiceProvider extends ServiceProvider
{
    public array $singletons = [FeedProvider::class => SQLiteFeedProvider::class];
}

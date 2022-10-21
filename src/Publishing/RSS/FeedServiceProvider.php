<?php declare(strict_types=1);

namespace Domain\Publishing\RSS;

use Domain\Publishing\RSS\Contracts\FeedRepository;
use Illuminate\Support\ServiceProvider;

final class FeedServiceProvider extends ServiceProvider
{
    public array $singletons = [FeedRepository::class => DatabaseFeedRepository::class];
}

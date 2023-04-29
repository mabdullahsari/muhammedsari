<?php declare(strict_types=1);

namespace Publishing;

use Illuminate\Support\AggregateServiceProvider;

final class PublishingServiceProvider extends AggregateServiceProvider
{
    public array $singletons = [UrlGenerator::class => PostUrlGenerator::class];

    protected $providers = [
        \Clock\ClockServiceProvider::class,
        \Publishing\RSS\FeedServiceProvider::class,
        \Publishing\Twitter\TwitterServiceProvider::class
    ];

    public function register(): void
    {
        parent::register();

        $this->app->when(PostUrlGenerator::class)->needs('$hostAndScheme')->giveConfig('app.url');
    }
}

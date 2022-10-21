<?php declare(strict_types=1);

namespace Domain\Publishing;

use Domain\Publishing\RSS\FeedServiceProvider;
use Domain\Publishing\Twitter\TwitterServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

final class PublishingServiceProvider extends AggregateServiceProvider
{
    public array $singletons = [UrlGenerator::class => PostUrlGenerator::class];

    protected $providers = [
        FeedServiceProvider::class,
        TwitterServiceProvider::class,
    ];

    public function register(): void
    {
        parent::register();

        $this->app->when(PostUrlGenerator::class)->needs('$hostAndScheme')->giveConfig('app.url');
    }
}

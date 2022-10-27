<?php declare(strict_types=1);

namespace Domain\Publishing\RSS;

use Carbon\CarbonImmutable;
use Domain\Publishing\UrlGenerator;
use Spatie\Feed\FeedItem;
use stdClass;

final class FeedItemMapper
{
    public function __construct(
        private readonly UrlGenerator $url,
    ) {}

    public function __invoke(stdClass $post): FeedItem
    {
        return FeedItem::create()
            ->authorEmail($post->email)
            ->authorName("{$post->first_name} {$post->last_name}")
            ->id($url = $this->url->generate($post->slug))
            ->link($url)
            ->summary($post->summary)
            ->title($post->title)
            ->updated(CarbonImmutable::createFromFormat('Y-m-d H:i:s', $post->updated_at)); // @phpstan-ignore-line
    }
}

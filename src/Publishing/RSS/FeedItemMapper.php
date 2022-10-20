<?php declare(strict_types=1);

namespace Domain\Publishing\RSS;

use Carbon\Carbon;
use Dive\Utils\Makeable;
use Domain\Publishing\UrlGenerator;
use Spatie\Feed\FeedItem;
use stdClass;

final class FeedItemMapper
{
    use Makeable;

    public function __construct(
        private readonly UrlGenerator $url,
    ) {}

    public function __invoke(stdClass $raw): FeedItem
    {
        return FeedItem::create()
            ->authorEmail($raw->email)
            ->authorName("{$raw->first_name} {$raw->last_name}")
            ->id($url = $this->url->generate($raw->slug))
            ->link($url)
            ->summary($raw->summary)
            ->title($raw->title)
            ->updated(Carbon::createFromFormat('Y-m-d H:i:s', $raw->updated_at)); // @phpstan-ignore-line
    }
}

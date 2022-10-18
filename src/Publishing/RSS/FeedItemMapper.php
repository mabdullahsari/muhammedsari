<?php declare(strict_types=1);

namespace Domain\Publishing\RSS;

use Carbon\Carbon;
use Dive\Utils\Makeable;
use Spatie\Feed\FeedItem;
use stdClass;

final class FeedItemMapper
{
    use Makeable;

    public function __invoke(stdClass $raw): FeedItem
    {
        return FeedItem::create()
            ->authorEmail($raw->email)
            ->authorName("{$raw->first_name} {$raw->last_name}")
            ->id($raw->slug)
            ->link('TODO')
            ->summary($raw->summary)
            ->title($raw->title)
            ->updated(Carbon::createFromFormat('Y-m-d H:i:s', $raw->updated_at)); // @phpstan-ignore-line
    }
}

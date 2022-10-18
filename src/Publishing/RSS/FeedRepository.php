<?php declare(strict_types=1);

namespace Domain\Publishing\RSS;

use Illuminate\Support\Collection;
use Spatie\Feed\FeedItem;

interface FeedRepository
{
    /** @return Collection<int, FeedItem> */
    public function items(): Collection;
}

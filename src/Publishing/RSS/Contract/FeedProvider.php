<?php declare(strict_types=1);

namespace Publishing\RSS\Contract;

use Illuminate\Support\Collection;
use Spatie\Feed\FeedItem;

interface FeedProvider
{
    /** @return Collection<int, FeedItem> */
    public function items(): Collection;
}

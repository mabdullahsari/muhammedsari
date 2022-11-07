<?php declare(strict_types=1);

namespace Tests\Unit\Core\Publishing\RSS;

use Core\Contracts\Publishing\RSS\FeedProvider;
use PHPUnit\Framework\TestCase;
use Spatie\Feed\FeedItem;

/** @mixin TestCase */
trait FeedProviderContractTests
{
    abstract private function getInstance(): FeedProvider;

    /** @test */
    public function it_can_get_a_collection_of_feed_items(): void
    {
        $provider = $this->getInstance();

        $items = $provider->items();

        $this->assertCount(1, $items);
        $this->assertInstanceOf(FeedItem::class, $items->first());
    }
}

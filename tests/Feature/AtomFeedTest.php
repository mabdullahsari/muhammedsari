<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\PostFactory;
use Tests\KernelTestCase;

final class AtomFeedTest extends KernelTestCase
{
    /** @test */
    public function test_feed_includes_published_posts(): void
    {
        $draft = PostFactory::new()->createQuietly();
        [$publishedA, $publishedB] = PostFactory::times(2)->published()->createQuietly();

        $response = $this->get('feed.atom');

        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml;charset=UTF-8')
            ->assertSee($publishedA->title)
            ->assertSee($publishedB->title)
            ->assertDontSee($draft->title);
    }
}

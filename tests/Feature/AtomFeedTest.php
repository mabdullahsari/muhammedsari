<?php declare(strict_types=1);

namespace Tests\Feature;

use Blogging\PostFactory;
use Identity\UserSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class AtomFeedTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
    }

    #[Test]
    public function feed_includes_published_posts(): void
    {
        // Arrange
        $draft = PostFactory::new()->createQuietly();
        $publishedA = PostFactory::new()->published()->createQuietly();
        $publishedB = PostFactory::new()->published()->createQuietly();

        // Act
        $response = $this->get('feed.atom');

        // Assert
        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml;charset=UTF-8')
            ->assertSee($publishedA->title)
            ->assertSee($publishedB->title)
            ->assertDontSee($draft->title);
    }
}

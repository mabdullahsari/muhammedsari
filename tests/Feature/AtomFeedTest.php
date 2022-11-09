<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\PostFactory;
use Database\Seeders\UserSeeder;
use Tests\KernelTestCase;

final class AtomFeedTest extends KernelTestCase
{
    protected bool $seed = true;

    protected string $seeder = UserSeeder::class;

    /** @test */
    public function test_feed_includes_published_posts(): void
    {
        // Arrange
        $draft = PostFactory::new()->createQuietly();
        [$publishedA, $publishedB] = PostFactory::times(2)->published()->createQuietly();

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

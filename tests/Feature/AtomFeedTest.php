<?php declare(strict_types=1);

namespace Tests\Feature;

use Blogging\Models\PostFactory;
use Identity\UserSeeder;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class AtomFeedTest extends KernelTestCase
{
    protected bool $seed = true;

    protected string $seeder = UserSeeder::class;

    #[Test]
    public function feed_includes_published_posts(): void
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

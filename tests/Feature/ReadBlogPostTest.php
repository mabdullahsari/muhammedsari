<?php declare(strict_types=1);

namespace Tests\Feature;

use Blogging\PostFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class ReadBlogPostTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function post_can_be_displayed(): void
    {
        // Arrange
        $post = PostFactory::new()->createQuietly();

        // Act
        $response = $this->get($post->slug);

        // Assert
        $response
            ->assertOk()
            ->assertSee($post->title);
    }

    #[Test]
    public function json_content_is_negotiable(): void
    {
        // Arrange
        $post = PostFactory::new()->published()->createQuietly();

        // Act
        $response = $this->getJson($post->slug);

        // Assert
        $response
            ->assertOk()
            ->assertJsonStructure(['body', 'published_at', 'slug', 'summary', 'tags', 'title']);
    }
}

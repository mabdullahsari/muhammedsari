<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\PostFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class GetSinglePostTest extends KernelTestCase
{
    public function post_can_be_displayed(): void
    {
        // Arrange
        $post = PostFactory::new()->createQuietly();

        // Act
        $response = $this->get("blog/{$post->slug}");

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
        $response = $this->getJson("blog/{$post->slug}");

        // Assert
        $response
            ->assertOk()
            ->assertJsonStructure(['body', 'published_at', 'slug', 'summary', 'tags', 'title']);
    }
}

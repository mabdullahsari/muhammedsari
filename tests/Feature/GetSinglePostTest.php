<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\PostFactory;
use Database\Seeders\UserSeeder;
use Tests\KernelTestCase;

final class GetSinglePostTest extends KernelTestCase
{
    protected bool $seed = true;

    protected string $seeder = UserSeeder::class;

    public function test_non_draft_posts_return_not_found(): void
    {
        // Arrange
        $post = PostFactory::new()->createQuietly();

        // Act
        $response = $this->get("blog/{$post->slug}");

        // Assert
        $response->assertNotFound();
    }

    public function test_published_post_can_be_displayed(): void
    {
        // Arrange
        $post = PostFactory::new()->published()->createQuietly();

        // Act
        $response = $this->get("blog/{$post->slug}");

        // Assert
        $response
            ->assertOk()
            ->assertSee($post->title);
    }

    /** @test */
    public function test_json_content_is_negotiable(): void
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

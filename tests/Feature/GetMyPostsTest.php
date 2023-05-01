<?php declare(strict_types=1);

namespace Tests\Feature;

use Blogging\PostFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class GetMyPostsTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    #[Test]
    public function only_published_posts_are_displayed(): void
    {
        // Arrange
        $draft = PostFactory::new()->createQuietly();
        [$publishedA, $publishedB] = PostFactory::times(2)->published()->createQuietly();

        // Act
        $response = $this->get('blog');

        // Assert
        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'text/html; charset=UTF-8')
            ->assertSee($publishedA->title)
            ->assertSee($publishedB->title)
            ->assertDontSee($draft->title);
    }

    #[Test]
    public function json_content_is_negotiable(): void
    {
        // Arrange
        PostFactory::new()->createQuietly();
        PostFactory::new()->published()->createQuietly();

        // Act
        $response = $this->getJson('blog');

        // Assert
        $response->assertOk()->assertJson(static function (AssertableJson $json) {
            $json->count(1)->each(fn ($json) => $json->hasAll(['published_at', 'slug', 'summary', 'tags', 'title']));
        });
    }
}

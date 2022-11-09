<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\PostFactory;
use Database\Seeders\UserSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\KernelTestCase;

final class GetMyPostsTest extends KernelTestCase
{
    protected bool $seed = true;

    protected string $seeder = UserSeeder::class;

    /** @test */
    public function test_only_published_posts_are_displayed(): void
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

    /** @test */
    public function test_json_content_is_negotiable(): void
    {
        // Arrange
        PostFactory::new()->createQuietly();
        PostFactory::new()->published()->createQuietly();

        // Act
        $response = $this->getJson('blog');

        // Assert
        $response->assertOk()->assertJson(static function (AssertableJson $json) {
            $json->count(1)->each(fn ($json) => $json->hasAll(['published_at', 'slug', 'summary', 'title']));
        });
    }
}

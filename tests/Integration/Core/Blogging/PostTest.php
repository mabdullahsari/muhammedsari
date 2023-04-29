<?php declare(strict_types=1);

namespace Tests\Integration\Core\Blogging;

use Blogging\Contract\PostPublished;
use Blogging\CouldNotPublish;
use Blogging\Post;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;
use Tests\Unit\Core\Blogging\PostFactoryMethods;

final class PostTest extends KernelTestCase
{
    use PostFactoryMethods;

    #[Test]
    public function it_is_impossible_to_publish_with_an_empty_body(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post body may not be missing.');

        $post = Post::factory()->publishable()->make(['body' => '']);

        $post->publish(
            $this->aClock()
        );
    }

    #[Test]
    public function it_is_impossible_to_publish_with_an_empty_summary(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post summary may not be missing.');

        $post = Post::factory()->publishable()->make(['summary' => '']);

        $post->publish(
            $this->aClock()
        );
    }

    #[Test]
    public function it_is_impossible_to_publish_without_tags(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post must have at least one tag.');

        $post = Post::factory()->publishable()->hasTags(0)->make();

        $post->publish(
            $this->aClock()
        );
    }

    #[Test]
    public function it_cannot_be_published_twice_or_more(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post may not be published more than once.');

        $post = Post::factory()->publishable()->createQuietly();

        $post->publish(
            $clock = $this->aClock()
        );

        $post->publish($clock);
    }

    #[Test]
    public function it_can_be_published(): void
    {
        $post = Post::factory()->publishable()->createQuietly();

        $post->publish(
            $this->aClock()
        );

        $this->assertEquals([
            new PostPublished($post->id, $post->slug, $post->tags->map->slug->all() , $post->title)
        ], $post->flushEvents());
    }
}

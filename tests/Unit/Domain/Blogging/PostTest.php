<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Blogging;

use Domain\Blogging\Exceptions\CouldNotPublish;
use Domain\Blogging\Post;
use Domain\Blogging\ValueObjects\Body;
use Domain\Blogging\ValueObjects\Slug;
use Domain\Blogging\ValueObjects\Summary;
use Domain\Blogging\ValueObjects\Title;
use Domain\Clock\FrozenClock;
use Domain\Contracts\Blogging\Events\PostWasPublished;
use PHPUnit\Framework\TestCase;

final class PostTest extends TestCase
{
    /** @test */
    public function it_is_impossible_to_publish_with_an_empty_body(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post body may not be missing.');

        $post = $this->createPost(['body' => Body::fromString('')]);

        $post->publish(
            $this->aClock()
        );
    }

    /** @test */
    public function it_is_impossible_to_publish_with_an_empty_summary(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post summary may not be missing.');

        $post = $this->createPost(['summary' => Summary::fromString('')]);

        $post->publish(
            $this->aClock()
        );
    }

    /** @test */
    public function it_cannot_be_published_twice_or_more(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post may not be published more than once.');

        $post = $this->createPost();

        $post->publish(
            $clock = $this->aClock()
        );

        $post->publish($clock);
    }

    /** @test */
    public function it_can_be_published(): void
    {
        $post = $this->createPost();

        $post->publish(
            $this->aClock()
        );

        $this->assertEquals([new PostWasPublished(1)], $post->flushEvents());
    }

    private function createPost(array $overrides = []): Post
    {
        $attributes = $overrides + [
            'id' => 1,
            'title' => Title::fromString('Never gonna give you up'),
            'slug' => Slug::fromString('never-gonna-give-you-up'),
            'body' => Body::fromString('Never gonna let you down'),
            'summary' => Summary::fromString('Never gonna turn around and desert you'),
        ];

        return Post::create(...$attributes);
    }

    private function aClock(): FrozenClock
    {
        return new FrozenClock('2022-10-26 22:17:30');
    }
}

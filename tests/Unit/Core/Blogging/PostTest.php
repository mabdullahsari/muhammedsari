<?php declare(strict_types=1);

namespace Tests\Unit\Core\Blogging;

use Core\Blogging\Body;
use Core\Blogging\CouldNotPublish;
use Core\Blogging\Summary;
use Core\Contract\Blogging\Event\PostWasPublished;
use PHPUnit\Framework\TestCase;

final class PostTest extends TestCase
{
    use PostFactoryMethods;

    /** @test */
    public function it_is_impossible_to_publish_with_an_empty_body(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post body may not be missing.');

        $post = $this->aPost(['body' => Body::fromString('')]);

        $post->publish(
            $this->aClock()
        );
    }

    /** @test */
    public function it_is_impossible_to_publish_with_an_empty_summary(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post summary may not be missing.');

        $post = $this->aPost(['summary' => Summary::fromString('')]);

        $post->publish(
            $this->aClock()
        );
    }

    /** @test */
    public function it_cannot_be_published_twice_or_more(): void
    {
        $this->expectException(CouldNotPublish::class);
        $this->expectExceptionMessage('Post may not be published more than once.');

        $post = $this->aPost();

        $post->publish(
            $clock = $this->aClock()
        );

        $post->publish($clock);
    }

    /** @test */
    public function it_can_be_published(): void
    {
        $post = $this->aPost();

        $post->publish(
            $this->aClock()
        );

        $this->assertEquals([new PostWasPublished(1)], $post->flushEvents());
    }
}

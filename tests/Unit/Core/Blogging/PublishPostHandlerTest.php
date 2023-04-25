<?php declare(strict_types=1);

namespace Tests\Unit\Core\Blogging;

use Blogging\InMemoryPostRepository;
use Blogging\PostId;
use Blogging\PublishPostHandler;
use Contract\Blogging\Command\PublishPost;
use Contract\Blogging\Event\PostWasPublished;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Testing\Fakes\EventFake;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PublishPostHandlerTest extends TestCase
{
    use PostFactoryMethods;

    #[Test]
    public function it_can_publish_a_blog_post(): void
    {
        $handler = new PublishPostHandler(
            $this->aClock(),
            $events = $this->aDispatcher(),
            $posts = $this->aPostRepository($id = 123),
        );

        $handler->handle(new PublishPost($id));

        $events->assertDispatched(PostWasPublished::class);
        $this->assertTrue($posts->wasSaved($id));
    }

    private function aDispatcher(): EventFake
    {
        return new EventFake(new Dispatcher(), PostWasPublished::class);
    }

    private function aPostRepository(int $id): InMemoryPostRepository
    {
        return new InMemoryPostRepository([
            $id => $this->aPost(['id' => PostId::fromInt($id)]),
        ]);
    }
}

<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Blogging;

use Domain\Blogging\InMemoryPostRepository;
use Domain\Blogging\PublishPostHandler;
use Domain\Contracts\Blogging\Commands\PublishPost;
use Domain\Contracts\Blogging\Events\PostWasPublished;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Testing\Fakes\EventFake;
use PHPUnit\Framework\TestCase;

final class PublishPostHandlerTest extends TestCase
{
    use PostFactoryMethods;

    /** @test */
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
            $id => $this->aPost(['id' => $id]),
        ]);
    }
}

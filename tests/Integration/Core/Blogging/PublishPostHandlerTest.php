<?php declare(strict_types=1);

namespace Tests\Integration\Core\Blogging;

use Blogging\Contract\PostPublished;
use Blogging\Contract\PublishPost;
use Blogging\Post;
use Blogging\PostState;
use Blogging\PublishPostHandler;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Testing\Fakes\EventFake;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;
use Tests\Unit\Core\Blogging\PostFactoryMethods;

final class PublishPostHandlerTest extends KernelTestCase
{
    use PostFactoryMethods;

    #[Test]
    public function it_can_publish_a_blog_post(): void
    {
        $handler = new PublishPostHandler(
            $clock = $this->aClock(),
            $events = $this->aDispatcher(),
            Post::factory()->publishable()->createQuietly(['id' => 1337]),
        );

        $handler->handle(new PublishPost(1337));

        $events->assertDispatched(PostPublished::class);
        $this->assertDatabaseHas(Post::class, [
            'id' => 1337,
            'published_at' => $clock->now()->format('Y-m-d H:i:s'),
            'state' => PostState::Published->value,
        ]);
    }

    private function aDispatcher(): EventFake
    {
        return Event::fake([PostPublished::class]);
    }
}

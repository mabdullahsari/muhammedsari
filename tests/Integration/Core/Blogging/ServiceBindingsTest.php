<?php declare(strict_types=1);

namespace Tests\Integration\Core\Blogging;

use Blogging\Contract\GetMyPosts;
use Blogging\Contract\GetSinglePost;
use Blogging\Contract\PublishPost;
use Blogging\GetMyPostsUsingEloquent;
use Blogging\GetSinglePostUsingEloquent;
use Blogging\Post;
use Blogging\PostObserver;
use Blogging\PostPolicy;
use Blogging\PublishPostHandler;
use Blogging\Tag;
use Blogging\TagPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    #[Test]
    public function it_registers_singleton_bindings(): void
    {
        $this->assertTrue($this->app->isShared(GetMyPosts::class));
        $this->assertInstanceOf(GetMyPostsUsingEloquent::class, $this->app->make(GetMyPosts::class));

        $this->assertTrue($this->app->isShared(GetSinglePost::class));
        $this->assertInstanceOf(GetSinglePostUsingEloquent::class, $this->app->make(GetSinglePost::class));
    }

    #[Test]
    public function it_registers_a_post_model_observer(): void
    {
        $events = $this->app->make('events');
        $listeners = $events->getRawListeners()['eloquent.deleted: ' . Post::class];

        $this->assertContains(PostObserver::class . '@deleted', $listeners);
    }

    #[Test]
    public function it_registers_policies_at_gate(): void
    {
        $gate = $this->app->make(Gate::class);

        $this->assertInstanceOf(PostPolicy::class, $gate->getPolicyFor(Post::class));
        $this->assertInstanceOf(TagPolicy::class, $gate->getPolicyFor(Tag::class));
    }

    #[Test]
    public function it_registers_commands_with_handlers(): void
    {
        $commands = $this->app->make(Dispatcher::class);

        $handler = $commands->getCommandHandler(new PublishPost(1));

        $this->assertInstanceOf(PublishPostHandler::class, $handler);
    }
}

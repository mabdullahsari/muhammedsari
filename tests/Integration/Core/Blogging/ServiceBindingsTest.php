<?php declare(strict_types=1);

namespace Tests\Integration\Core\Blogging;

use Core\Blogging\Models\Author;
use Core\Blogging\Models\Post;
use Core\Blogging\Models\PostObserver;
use Core\Blogging\Models\PostPolicy;
use Core\Blogging\Models\Tag;
use Core\Blogging\Models\TagPolicy;
use Core\Blogging\PostRepository;
use Core\Blogging\PublishPostHandler;
use Core\Blogging\SQLitePostRepository;
use Core\Contract\Blogging\Command\PublishPost;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Database\Eloquent\Relations\Relation;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    /** @test */
    public function it_registers_models_into_morph_map(): void
    {
        $author = Relation::getMorphedModel('author');
        $post = Relation::getMorphedModel('post');
        $tag = Relation::getMorphedModel('tag');

        $this->assertSame(Author::class, $author);
        $this->assertSame(Post::class, $post);
        $this->assertSame(Tag::class, $tag);
    }

    /** @test */
    public function it_registers_singleton_bindings(): void
    {
        $this->assertTrue($this->app->isShared(PostRepository::class));
        $this->assertInstanceOf(SQLitePostRepository::class, $this->app->make(PostRepository::class));
    }

    /** @test */
    public function it_registers_a_post_model_observer(): void
    {
        $events = $this->app->make('events');
        $listeners = $events->getRawListeners()['eloquent.deleted: ' . Post::class];

        $this->assertContains(PostObserver::class . '@deleted', $listeners);
    }

    /** @test */
    public function it_registers_policies_at_gate(): void
    {
        $gate = $this->app->make(Gate::class);

        $this->assertInstanceOf(PostPolicy::class, $gate->getPolicyFor(Post::class));
        $this->assertInstanceOf(TagPolicy::class, $gate->getPolicyFor(Tag::class));
    }

    /** @test */
    public function it_registers_commands_with_handlers(): void
    {
        $commands = $this->app->make(Dispatcher::class);

        $handler = $commands->getCommandHandler(new PublishPost(1));

        $this->assertInstanceOf(PublishPostHandler::class, $handler);
    }
}

<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Blogging;

use Domain\Blogging\Access\PostPolicy;
use Domain\Blogging\Access\TagPolicy;
use Domain\Blogging\Handlers\PublishPostHandler;
use Domain\Blogging\Models\Author;
use Domain\Blogging\Models\Observers\PostObserver;
use Domain\Blogging\Models\Post;
use Domain\Blogging\Models\Tag;
use Domain\Blogging\PostRepository;
use Domain\Blogging\SQLitePostRepository;
use Domain\Contracts\Blogging\Commands\PublishPost;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Database\Eloquent\Relations\Relation;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

final class ServiceBindingsTest extends TestCase
{
    use CreatesApplication;

    /** @test */
    public function it_registers_models_into_morph_map(): void
    {
        $this->createApplication();

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
        $app = $this->createApplication();

        $this->assertTrue($app->isShared(PostRepository::class));
        $this->assertInstanceOf(SQLitePostRepository::class, $app->make(PostRepository::class));
    }

    /** @test */
    public function it_registers_a_post_model_observer(): void
    {
        $app = $this->createApplication();

        /** @var \Illuminate\Contracts\Events\Dispatcher $events */
        $events = $app->make('events');
        $listeners = $events->getRawListeners()['eloquent.deleted: ' . Post::class];

        $this->assertContains(PostObserver::class . '@deleted', $listeners);
    }

    /** @test */
    public function it_registers_policies_at_gate(): void
    {
        $app = $this->createApplication();

        /** @var Gate $gate */
        $gate = $app->make(Gate::class);

        $this->assertInstanceOf(PostPolicy::class, $gate->getPolicyFor(Post::class));
        $this->assertInstanceOf(TagPolicy::class, $gate->getPolicyFor(Tag::class));
    }

    /** @test */
    public function it_registers_commands_with_handlers(): void
    {
        $app = $this->createApplication();

        /** @var Dispatcher $commands */
        $commands = $app->make(Dispatcher::class);

        $handler = $commands->getCommandHandler(new PublishPost(1));

        $this->assertInstanceOf(PublishPostHandler::class, $handler);
    }

    public static function tearDownAfterClass(): void
    {
        Relation::morphMap([], false);
    }
}

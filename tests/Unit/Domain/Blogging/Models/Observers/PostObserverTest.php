<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Blogging\Models\Observers;

use Domain\Blogging\Models\Observers\PostObserver;
use Domain\Blogging\Models\Post;
use Domain\Contracts\Blogging\Events\PostWasDeleted;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Testing\Fakes\EventFake;
use PHPUnit\Framework\TestCase;

final class PostObserverTest extends TestCase
{
    /** @test */
    public function it_produces_a_custom_deleted_event_upon_deletion(): void
    {
        $events = new EventFake(new Dispatcher());

        (new PostObserver($events))->deleted(
            (new Post())->setAttribute('id', 1453)
        );

        $events->assertDispatched(PostWasDeleted::class, fn ($event) => $event->id === 1453);
    }
}

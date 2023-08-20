<?php declare(strict_types=1);

namespace Tests\Unit\Blogging;

use Blogging\Contract\PostDeleted;
use Blogging\Post;
use Blogging\PostObserver;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Testing\Fakes\EventFake;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PostObserverTest extends TestCase
{
    #[Test]
    public function it_produces_a_custom_deleted_event_upon_deletion(): void
    {
        $events = new EventFake(new Dispatcher());

        $model = new Post();
        $model->setAttribute('id', 1453);

        (new PostObserver($events))->deleted($model);

        $events->assertDispatched(PostDeleted::class, fn ($event) => $event->id === 1453);
    }
}

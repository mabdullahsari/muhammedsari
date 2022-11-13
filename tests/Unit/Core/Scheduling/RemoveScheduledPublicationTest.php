<?php declare(strict_types=1);

namespace Tests\Unit\Core\Scheduling;

use Core\Contract\Blogging\Event\PostWasDeleted;
use Core\Contract\Blogging\Event\PostWasPublished;
use Core\Scheduling\CouldNotFindPublication;
use Core\Scheduling\InMemoryPublicationRepository;
use Core\Scheduling\Publication;
use Core\Scheduling\RemoveScheduledPublication;
use PHPUnit\Framework\TestCase;

final class RemoveScheduledPublicationTest extends TestCase
{
    use PublicationFactoryMethods;

    /**
     * @dataProvider events
     * @test
     */
    public function it_can_remove_a_scheduled_publication(string $event): void
    {
        $publications = new InMemoryPublicationRepository([1234 => new Publication(1234, 56, $this->now())]);
        $listener = new RemoveScheduledPublication($publications);

        $listener->handle(new $event(56));

        $this->expectException(CouldNotFindPublication::class);

        $publications->find(1234);
    }

    private function events(): array
    {
        return [
            [PostWasPublished::class],
            [PostWasDeleted::class],
        ];
    }
}

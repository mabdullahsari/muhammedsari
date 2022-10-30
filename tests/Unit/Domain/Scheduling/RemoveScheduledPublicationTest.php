<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Scheduling;

use Domain\Contracts\Blogging\Events\PostWasDeleted;
use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Scheduling\CouldNotFindPublication;
use Domain\Scheduling\InMemoryPublicationRepository;
use Domain\Scheduling\Publication;
use Domain\Scheduling\RemoveScheduledPublication;
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

        $listener->handle(new $event(56)); // @phpstan-ignore-line

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

<?php declare(strict_types=1);

namespace Tests\Unit\Core\Scheduling;

use Contract\Blogging\Event\PostWasDeleted;
use Contract\Blogging\Event\PostWasPublished;
use Scheduling\CouldNotFindPublication;
use Scheduling\InMemoryPublicationRepository;
use Scheduling\Publication;
use Scheduling\RemoveScheduledPublication;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RemoveScheduledPublicationTest extends TestCase
{
    use PublicationFactoryMethods;

    #[DataProvider('events')]
    #[Test]
    public function it_can_remove_a_scheduled_publication(string $event): void
    {
        $publications = new InMemoryPublicationRepository([1234 => new Publication(1234, 56, $this->now())]);
        $listener = new RemoveScheduledPublication($publications);

        $listener->handle(new $event(56));

        $this->expectException(CouldNotFindPublication::class);

        $publications->find(1234);
    }

    public static function events(): array
    {
        return [
            [PostWasPublished::class],
            [PostWasDeleted::class],
        ];
    }
}

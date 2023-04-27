<?php declare(strict_types=1);

namespace Tests\Unit\Core\Scheduling;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Scheduling\CouldNotFindPublication;
use Scheduling\InMemoryPublicationRepository;
use Scheduling\Publication;
use Scheduling\RemoveScheduledPublication;

final class RemoveScheduledPublicationTest extends TestCase
{
    use PublicationFactoryMethods;

    #[Test]
    public function it_can_remove_a_scheduled_publication(): void
    {
        $publications = new InMemoryPublicationRepository([1234 => new Publication(1234, 56, $this->now())]);
        $listener = new RemoveScheduledPublication(56);

        $listener->handle($publications);

        $this->expectException(CouldNotFindPublication::class);

        $publications->find(1234);
    }
}

<?php declare(strict_types=1);

namespace Tests\Unit\Core\Scheduling;

use Blogging\Contract\PostDeleted;
use Blogging\Contract\PostPublished;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Scheduling\CouldNotFindPublication;
use Scheduling\InMemoryPublicationRepository;
use Scheduling\Publication;
use Scheduling\RemoveScheduledPublication;

final class RemoveScheduledPublicationTest extends TestCase
{
    use PublicationFactoryMethods;

    #[DataProvider('events')]
    #[Test]
    public function it_can_remove_a_scheduled_publication($event): void
    {
        $publications = new InMemoryPublicationRepository([1234 => new Publication(1234, 56, $this->now())]);
        $listener = new RemoveScheduledPublication($publications);

        $listener->handle($event);

        $this->expectException(CouldNotFindPublication::class);

        $publications->find(1234);
    }

    public static function events(): array
    {
        return [
            [new PostPublished(56, 'this-is-a-test', [], 'This is a test')],
            [new PostDeleted(56)],
        ];
    }
}

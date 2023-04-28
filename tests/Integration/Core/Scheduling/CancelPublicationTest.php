<?php declare(strict_types=1);

namespace Tests\Integration\Core\Scheduling;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\Attributes\Test;
use Scheduling\Publication;
use Scheduling\CancelPublication;
use Tests\KernelTestCase;

final class CancelPublicationTest extends KernelTestCase
{
    #[Test]
    public function it_can_remove_a_scheduled_publication(): void
    {
        $publication = Publication::factory()->createQuietly();
        $listener = new CancelPublication($publication->post_id);

        $listener->handle($publication);

        $this->expectException(ModelNotFoundException::class);
        $publication->refresh();
    }
}

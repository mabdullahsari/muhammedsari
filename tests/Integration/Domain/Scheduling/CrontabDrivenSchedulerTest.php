<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Scheduling;

use Domain\Clock\FrozenClock;
use Domain\Contracts\Blogging\Commands\PublishPost;
use Domain\Scheduling\CrontabDrivenScheduler;
use Domain\Scheduling\InMemoryPublicationRepository;
use Domain\Scheduling\Publication;
use Domain\Scheduling\PublicationRepository;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Testing\Fakes\BusFake;
use Tests\KernelTestCase;
use Tests\Unit\Domain\Scheduling\PublicationFactoryMethods;

final class CrontabDrivenSchedulerTest extends KernelTestCase
{
    use PublicationFactoryMethods;

    /** @test */
    public function it_dispatches_commands_for_publications_that_are_due(): void
    {
        $scheduler = new CrontabDrivenScheduler($this->aClock(), $bus = $this->aBus(), $this->aRepository());

        $scheduler->tick();

        $bus->assertDispatchedTimes(PublishPost::class);
    }

    private function aBus(): BusFake
    {
        return Bus::fake([PublishPost::class]);
    }

    private function aClock(): FrozenClock
    {
        return new FrozenClock('2022-10-30 00:00:00');
    }

    private function aRepository(): PublicationRepository
    {
        return new InMemoryPublicationRepository([
            1 => new Publication(1, 1, $this->date('2022-10-29')),
            2 => new Publication(2, 2, $this->date('2022-10-31')),
            3 => new Publication(3, 3, $this->date('2022-11-01')),
        ]);
    }
}

<?php declare(strict_types=1);

namespace Tests\Integration\Core\Scheduling;

use Blogging\Contract\PublishPost;
use Clock\FrozenClock;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Testing\Fakes\BusFake;
use PHPUnit\Framework\Attributes\Test;
use Scheduling\CrontabScheduler;
use Scheduling\Publication;
use Tests\KernelTestCase;

final class CrontabSchedulerTest extends KernelTestCase
{
    #[Test]
    public function it_dispatches_commands_for_upcoming_publications(): void
    {
        $scheduler = new CrontabScheduler($this->aClock(), $bus = $this->aBus(), $this->aModel());

        $scheduler->tick();

        $bus->assertDispatchedTimes(static fn (PublishPost $cmd) => $cmd->id === 1337);
    }

    private function aBus(): BusFake
    {
        return Bus::fake([PublishPost::class]);
    }

    private function aClock(): FrozenClock
    {
        return new FrozenClock('2022-10-30 00:00:00');
    }

    private function aModel(): Publication
    {
        return Publication::factory(3)->sequence(
            ['post_id' => 1337, 'publish_at' => '2022-10-29'],
            ['post_id' => 619, 'publish_at' => '2022-10-31'],
            ['post_id' => 47, 'publish_at' => '2022-11-01']
        )->createQuietly()->first();
    }
}

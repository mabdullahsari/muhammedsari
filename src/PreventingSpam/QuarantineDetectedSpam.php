<?php declare(strict_types=1);

namespace PreventingSpam;

use Clock\Contract\Clock;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use PreventingSpam\Contract\PotentialSpam;

final readonly class QuarantineDetectedSpam implements ShouldQueue
{
    public function __construct(
        private DetectionMethod $detection,
        private PotentialSpam $spam,
    ) {}

    public function handle(Clock $clock, Dispatcher $events, QuarantinedMessageRepository $messages): void
    {
        $message = QuarantinedMessage::quarantine(
            $messages->nextIdentity(),
            $this->detection,
            Message::fromSpam($this->spam),
            $clock,
        );

        $messages->save($message);

        [$event] = $message->flushEvents();
        $events->dispatch($event);
    }
}

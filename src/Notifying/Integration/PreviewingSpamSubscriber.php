<?php declare(strict_types=1);

namespace Notifying\Integration;

use Illuminate\Contracts\Events\Dispatcher;
use Notifying\LogQuarantinedMessage;
use PreventingSpam\Contract\MessageQuarantined;

final readonly class PreviewingSpamSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(MessageQuarantined::class, $this->whenMessageQuarantined(...));
    }

    private function whenMessageQuarantined(MessageQuarantined $event): void
    {
        LogQuarantinedMessage::dispatch($event->message, $event->quarantinedAt);
    }
}

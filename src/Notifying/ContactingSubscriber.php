<?php declare(strict_types=1);

namespace Notifying;

use Contacting\Contract\MuhammedContacted;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class ContactingSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(MuhammedContacted::class, $this->whenMuhammedContacted(...));
    }

    private function whenMuhammedContacted(MuhammedContacted $event): void
    {
        SendSomeoneGotInTouchMail::dispatch(
            new SomeoneGotInTouch($event->email, $event->message, $event->name)
        );
    }
}

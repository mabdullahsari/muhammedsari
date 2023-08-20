<?php declare(strict_types=1);

namespace Notifying\Integration;

use Contacting\Contract\MuhammedContacted;
use Illuminate\Contracts\Events\Dispatcher;
use Notifying\SendSomeoneGotInTouchMail;
use Notifying\SomeoneGotInTouch;

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

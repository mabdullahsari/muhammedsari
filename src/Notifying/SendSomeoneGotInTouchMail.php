<?php declare(strict_types=1);

namespace Notifying;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

final readonly class SendSomeoneGotInTouchMail implements ShouldQueue
{
    use Dispatchable;

    public function __construct(private SomeoneGotInTouch $data) {}

    public function handle(Mailer $mailer, Muhammed $me): void
    {
        $mailer->send(new SomeoneGotInTouchMail($this->data, $me));
    }
}

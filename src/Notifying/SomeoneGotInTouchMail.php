<?php declare(strict_types=1);

namespace Notifying;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

final class SomeoneGotInTouchMail extends Mailable
{
    public function __construct(
        private readonly SomeoneGotInTouch $data,
        private readonly Muhammed $me,
    ) {}

    public function content(): Content
    {
        return new Content(htmlString: nl2br($this->data->message));
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [$this->me->email],
            replyTo: [$this->data->email],
            subject: "{$this->data->name} got in touch",
        );
    }
}

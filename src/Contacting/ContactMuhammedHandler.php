<?php declare(strict_types=1);

namespace Contacting;

use Contacting\Contract\ContactMuhammed;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class ContactMuhammedHandler
{
    public function __construct(private Dispatcher $events) {}

    public function handle(ContactMuhammed $command): void
    {
        $form = ContactForm::submit($command->email, $command->ipAddress, $command->message, $command->name);
        $form->save();

        [$event] = $form->flushEvents();
        $this->events->dispatch($event);
    }
}

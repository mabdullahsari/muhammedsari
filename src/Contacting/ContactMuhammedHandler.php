<?php declare(strict_types=1);

namespace Contacting;

use Contacting\Contract\ContactMuhammed;

final readonly class ContactMuhammedHandler
{
    public function handle(ContactMuhammed $command): void
    {
        $form = ContactForm::submit($command->email, $command->ipAddress, $command->message, $command->name);
        $form->save();
    }
}

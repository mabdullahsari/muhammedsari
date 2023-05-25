<?php declare(strict_types=1);

namespace PreventingSpam;

use Illuminate\Contracts\Bus\Dispatcher;
use PreventingSpam\Contract\ExecuteAnyway;

final readonly class ExecuteAnywayHandler
{
    public function __construct(
        private Dispatcher $commands,
        private QuarantinedMessageRepository $messages,
    ) {}

    public function handle(ExecuteAnyway $command): void
    {
        $message = $this->messages->find(QuarantinedMessageId::fromInt($command->id));

        $this->commands->getCommandHandler(
            $original = $message->reconstituteOriginalMessage()
        )->handle($original);
    }
}

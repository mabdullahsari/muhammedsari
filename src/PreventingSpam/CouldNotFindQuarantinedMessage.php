<?php declare(strict_types=1);

namespace PreventingSpam;

use Exception;

final class CouldNotFindQuarantinedMessage extends Exception
{
    public static function withId(QuarantinedMessageId $id): self
    {
        return new self("Message with id {$id->asInt()} could not be found.");
    }
}

<?php declare(strict_types=1);

namespace PreventingSpam;

interface QuarantinedMessageRepository
{
    public function find(QuarantinedMessageId $id): QuarantinedMessage;
    public function nextIdentity(): QuarantinedMessageId;
    public function save(QuarantinedMessage $message): void;
}

<?php declare(strict_types=1);

namespace PreventingSpam;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\SQLiteConnection;

final readonly class QuarantinedMessageRepositoryUsingSQLite implements QuarantinedMessageRepository
{
    public const TABLE = 'preventing_spam_quarantined_messages';

    public function __construct(private SQLiteConnection $db) {}

    /** @throws CouldNotFindQuarantinedMessage */
    public function find(QuarantinedMessageId $id): QuarantinedMessage
    {
        $record = $this->newQuery()->where('id', $id->asInt())->first();

        if (! $record) {
            throw CouldNotFindQuarantinedMessage::withId($id);
        }

        return QuarantinedMessage::fromDatabase((array) $record);
    }

    public function nextIdentity(): QuarantinedMessageId
    {
        return QuarantinedMessageId::fromInt($this->newQuery()->max('id') + 1);
    }

    public function save(QuarantinedMessage $message): void
    {
        $this->newQuery()->insert($message->toDatabase());
    }

    private function newQuery(): Builder
    {
        return $this->db->table(self::TABLE);
    }
}

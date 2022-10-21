<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;
use Domain\Scheduling\Exceptions\CouldNotFindEntry;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

final class DatabaseEntryRepository implements EntryRepository
{
    public function __construct(
        private readonly ConnectionInterface $db,
    ) {}

    public function findById(int $id): Entry
    {
        $record = $this->newQuery()->findOr($id, static fn () => throw CouldNotFindEntry::withPostId($id));

        return Entry::fromDatabase($record);
    }

    public function findByPost(int $id): Entry
    {
        $record = $this->newQuery()->where('post_id', $id)->first();

        if (is_null($record)) {
            throw CouldNotFindEntry::withPostId($id);
        }

        return Entry::fromDatabase($record);
    }

    public function getBefore(CarbonImmutable $datetime): Collection
    {
        return $this
            ->newQuery()
            ->where('publish_at', '<', $datetime)
            ->get()
            ->transform(Entry::fromDatabase(...));
    }

    public function remove(Entry $entry): void
    {
        $this->newQuery()->delete($entry->id);
    }

    private function newQuery(): Builder
    {
        return $this->db->table('entries');
    }
}

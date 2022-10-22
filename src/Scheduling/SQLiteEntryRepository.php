<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;
use Domain\Scheduling\Exceptions\CouldNotFindEntry;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Collection;

final class SQLiteEntryRepository implements EntryRepository
{
    public function __construct(
        private readonly SQLiteConnection $db,
        private readonly EntryMapper $mapper,
    ) {}

    public function findById(int $id): Entry
    {
        $record = $this->newQuery()->findOr($id, static fn () => throw CouldNotFindEntry::withPostId($id));

        return $this->mapper->map($record);
    }

    public function findByPost(int $id): Entry
    {
        $record = $this->newQuery()->where('post_id', $id)->first();

        if (is_null($record)) {
            throw CouldNotFindEntry::withPostId($id);
        }

        return $this->mapper->map($record);
    }

    public function getBefore(CarbonImmutable $datetime): Collection
    {
        return $this
            ->newQuery()
            ->where('publish_at', '<', $datetime)
            ->get()
            ->transform($this->mapper);
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

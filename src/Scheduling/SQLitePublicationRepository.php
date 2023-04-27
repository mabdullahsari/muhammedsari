<?php declare(strict_types=1);

namespace Scheduling;

use Carbon\CarbonImmutable;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Collection;

final readonly class SQLitePublicationRepository implements PublicationRepository
{
    public function __construct(
        private SQLiteConnection $db,
        private PublicationMapper $mapper,
    ) {}

    public function find(int $id): Publication
    {
        $record = $this->newQuery()->findOr($id, static fn () => throw CouldNotFindPublication::withPostId($id));

        return $this->mapper->map($record);
    }

    public function findByPost(int $id): Publication
    {
        $record = $this->newQuery()->where('post_id', $id)->first();

        if (is_null($record)) {
            throw CouldNotFindPublication::withPostId($id);
        }

        return $this->mapper->map($record);
    }

    public function getDue(CarbonImmutable $now): Collection
    {
        return $this
            ->newQuery()
            ->where('publish_at', '<', $now)
            ->get()
            ->transform($this->mapper);
    }

    public function remove(Publication $publication): void
    {
        $this->newQuery()->delete($publication->id);
    }

    private function newQuery(): Builder
    {
        return $this->db->table('scheduling_publications');
    }
}

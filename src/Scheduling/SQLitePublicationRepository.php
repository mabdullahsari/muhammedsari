<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;
use Domain\Scheduling\Exceptions\CouldNotFindPublication;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Collection;

final class SQLitePublicationRepository implements PublicationRepository
{
    public function __construct(
        private readonly SQLiteConnection $db,
        private readonly PublicationMapper $mapper,
    ) {}

    public function findById(int $id): Publication
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
        return $this->db->table('publications');
    }
}

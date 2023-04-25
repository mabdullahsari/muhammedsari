<?php declare(strict_types=1);

namespace Scheduling;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

interface PublicationRepository
{
    /** @throws CouldNotFindPublication */
    public function find(int $id): Publication;

    /** @throws CouldNotFindPublication */
    public function findByPost(int $id): Publication;

    /** @return Collection<int, Publication> */
    public function getDue(CarbonImmutable $now): Collection;

    public function remove(Publication $publication): void;
}

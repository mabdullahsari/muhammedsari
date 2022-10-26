<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;
use Domain\Scheduling\Exceptions\CouldNotFindPublication;
use Illuminate\Support\Collection;

interface PublicationRepository
{
    /** @throws CouldNotFindPublication */
    public function findById(int $id): Publication;

    /** @throws CouldNotFindPublication */
    public function findByPost(int $id): Publication;

    /** @return Collection<int, Publication> */
    public function getDue(CarbonImmutable $now): Collection;

    public function remove(Publication $publication): void;
}

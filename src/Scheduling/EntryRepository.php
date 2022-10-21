<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;
use Domain\Scheduling\Exceptions\CouldNotFindEntry;
use Illuminate\Support\Collection;

interface EntryRepository
{
    /** @throws CouldNotFindEntry */
    public function findById(int $id): Entry;

    /** @throws CouldNotFindEntry */
    public function findByPost(int $id): Entry;

    /** @return Collection<int, Entry> */
    public function getBefore(CarbonImmutable $datetime): Collection;

    public function remove(Entry $entry): void;
}

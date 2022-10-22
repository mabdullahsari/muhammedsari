<?php declare(strict_types=1);

namespace Domain\Scheduling\Listeners;

use Domain\Contracts\Blogging\Events\PostWasDeleted;
use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Scheduling\EntryRepository;
use Domain\Scheduling\Exceptions\CouldNotFindEntry;

final class RemoveScheduledEntry
{
    public function __construct(
        private readonly EntryRepository $entries,
    ) {}

    public function handle(PostWasDeleted|PostWasPublished $event): void
    {
        try {
            $entry = $this->entries->findByPost($event->id);
        } catch (CouldNotFindEntry) {
            return;
        }

        $this->entries->remove($entry);
    }
}

<?php declare(strict_types=1);

namespace Domain\Scheduling\Listeners;

use Domain\Blogging\Contracts\Events\PostWasDeleted;
use Domain\Scheduling\EntryRepository;
use Domain\Scheduling\Exceptions\CouldNotFindEntry;

final class RemoveScheduledEntry
{
    public function __construct(
        private readonly EntryRepository $entries,
    ) {}

    public function handle(PostWasDeleted $event): void
    {
        try {
            $entry = $this->entries->findByPost($event->id());
        } catch (CouldNotFindEntry) {
            return;
        }

        $this->entries->remove($entry);
    }
}

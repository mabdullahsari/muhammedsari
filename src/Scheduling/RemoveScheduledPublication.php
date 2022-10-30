<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Domain\Contracts\Blogging\Events\PostWasDeleted;
use Domain\Contracts\Blogging\Events\PostWasPublished;

final class RemoveScheduledPublication
{
    public function __construct(
        private readonly PublicationRepository $publications,
    ) {}

    public function handle(PostWasDeleted|PostWasPublished $event): void
    {
        try {
            $publication = $this->publications->findByPost($event->id);
        } catch (CouldNotFindPublication) {
            return;
        }

        $this->publications->remove($publication);
    }
}
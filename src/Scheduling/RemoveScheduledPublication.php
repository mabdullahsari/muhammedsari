<?php declare(strict_types=1);

namespace Core\Scheduling;

use Core\Contract\Blogging\Event\PostWasDeleted;
use Core\Contract\Blogging\Event\PostWasPublished;

final readonly class RemoveScheduledPublication
{
    public function __construct(private PublicationRepository $publications) {}

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

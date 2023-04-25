<?php declare(strict_types=1);

namespace Scheduling;

use Blogging\Contract\PostDeleted;
use Blogging\Contract\PostPublished;

final readonly class RemoveScheduledPublication
{
    public function __construct(private PublicationRepository $publications) {}

    public function handle(PostDeleted|PostPublished $event): void
    {
        try {
            $publication = $this->publications->findByPost($event->id);
        } catch (CouldNotFindPublication) {
            return;
        }

        $this->publications->remove($publication);
    }
}

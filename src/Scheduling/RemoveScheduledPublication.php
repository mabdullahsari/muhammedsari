<?php declare(strict_types=1);

namespace Scheduling;

final readonly class RemoveScheduledPublication
{
    public function __construct(private int $postId) {}

    public function handle(PublicationRepository $publications): void
    {
        try {
            $publication = $publications->findByPost($this->postId);
        } catch (CouldNotFindPublication) {
            return;
        }

        $publications->remove($publication);
    }
}

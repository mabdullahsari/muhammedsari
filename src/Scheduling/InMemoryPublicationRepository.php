<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

final readonly class InMemoryPublicationRepository implements PublicationRepository
{
    private Collection $publications;

    public function __construct(array $publications)
    {
        $this->publications = Collection::make($publications);
    }

    public function find(int $id): Publication
    {
        return $this->publications->get($id, static fn () => throw CouldNotFindPublication::withId($id));
    }

    public function findByPost(int $id): Publication
    {
        return $this->publications->first(
            static fn (Publication $p) => $p->postId === $id,
            static fn () => throw CouldNotFindPublication::withPostId($id)
        );
    }

    public function getDue(CarbonImmutable $now): Collection
    {
        return Collection::make($this->publications)
            ->filter(static fn (Publication $publication) => $publication->publishAt->lessThan($now));
    }

    public function remove(Publication $publication): void
    {
        $this->publications->forget($publication->id);
    }
}

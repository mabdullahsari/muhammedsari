<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

final class InMemoryPublishedPostProvider implements PublishedPostProvider
{
    public function __construct(
        private readonly array $posts = [],
    ) {}

    public function getById(int $id): PublishedPost
    {
        if (! array_key_exists($id, $this->posts)) {
            throw CouldNotFindPost::withId($id);
        }

        return $this->posts[$id];
    }
}

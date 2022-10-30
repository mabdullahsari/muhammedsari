<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

final class InMemoryPostProvider implements PostProvider
{
    public function __construct(
        private readonly array $posts = [],
    ) {}

    public function getById(int $id): Post
    {
        if (! array_key_exists($id, $this->posts)) {
            throw CouldNotFindPost::withId($id);
        }

        return $this->posts[$id];
    }
}

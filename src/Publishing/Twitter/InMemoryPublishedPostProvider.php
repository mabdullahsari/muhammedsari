<?php declare(strict_types=1);

namespace Core\Publishing\Twitter;

final readonly class InMemoryPublishedPostProvider implements PublishedPostProvider
{
    public function __construct(private array $posts = []) {}

    public function getById(int $id): PublishedPost
    {
        if (! array_key_exists($id, $this->posts)) {
            throw CouldNotFindPost::withId($id);
        }

        return $this->posts[$id];
    }
}

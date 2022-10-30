<?php declare(strict_types=1);

namespace Domain\Blogging;

final class InMemoryPostRepository implements PostRepository
{
    private array $saves = [];

    public function __construct(
        private array $posts = [],
    ) {}

    public function find(int $id): Post
    {
        if (! array_key_exists($id, $this->posts)) {
            throw CouldNotFindPost::withId($id);
        }

        return $this->posts[$id];
    }

    public function save(Post $post): void
    {
        $this->posts[$post->id()] = $post;
        $this->saves[] = $post->id();
    }

    public function wasSaved(int $id): bool
    {
        return in_array($id, $this->saves);
    }
}

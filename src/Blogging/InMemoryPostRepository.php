<?php declare(strict_types=1);

namespace Domain\Blogging;

final class InMemoryPostRepository implements PostRepository
{
    /** @var Post[] */
    private array $posts = [];

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
    }
}

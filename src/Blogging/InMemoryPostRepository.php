<?php declare(strict_types=1);

namespace Blogging;

final class InMemoryPostRepository implements PostRepository
{
    private array $saves = [];

    public function __construct(private array $posts = []) {}

    public function find(PostId $id): Post
    {
        if (! array_key_exists($id->asInt(), $this->posts)) {
            throw CouldNotFindPost::withId($id);
        }

        return $this->posts[$id->asInt()];
    }

    public function save(Post $post): void
    {
        $this->posts[$id = $post->id()->asInt()] = $post;
        $this->saves[] = $id;
    }

    public function wasSaved(int $id): bool
    {
        return in_array($id, $this->saves);
    }
}

<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Blogging\Exceptions\CouldNotFindPost;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;
use stdClass;

final class DatabasePostRepository implements PostRepository
{
    public function __construct(
        private readonly ConnectionInterface $db,
    ) {}

    public function find(int $id): Post
    {
        /** @var stdClass|null $record */
        $record = $this->newQuery()->find($id);

        if (is_null($record)) {
            throw CouldNotFindPost::withId($id);
        }

        return Post::fromDatabase($record);
    }

    public function save(Post $post): void
    {
        $this->newQuery()->where('id', $post->id())->update($post->toDatabase());
    }

    private function newQuery(): Builder
    {
        return $this->db->table('posts');
    }
}

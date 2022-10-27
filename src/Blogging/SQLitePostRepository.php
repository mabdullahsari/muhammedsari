<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Contracts\Clock\Clock;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\SQLiteConnection;
use stdClass;

final class SQLitePostRepository implements PostRepository
{
    public function __construct(
        private readonly Clock $clock,
        private readonly SQLiteConnection $db,
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
        $values = $post->toDatabase();
        $values['updated_at'] = $this->clock->now()->toDateTimeString();

        $this->newQuery()->where('id', $post->id())->update($values);
    }

    private function newQuery(): Builder
    {
        return $this->db->table('posts');
    }
}

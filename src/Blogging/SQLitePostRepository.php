<?php declare(strict_types=1);

namespace Core\Blogging;

use Core\Contract\Clock\Clock;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\SQLiteConnection;
use stdClass;

final readonly class SQLitePostRepository implements PostRepository
{
    public function __construct(
        private Clock $clock,
        private SQLiteConnection $db,
    ) {}

    public function find(PostId $id): Post
    {
        /** @var stdClass|null $record */
        $record = $this->newQuery()->find($id->asInt());

        if (is_null($record)) {
            throw CouldNotFindPost::withId($id);
        }

        return Post::fromDatabase($record)->markAsPersisted();
    }

    public function save(Post $post): void
    {
        $values = $post->toDatabase();

        $now = $this->clock->now()->toDateTimeString();
        $values['updated_at'] = $now;

        if ($post->wasRecentlyCreated()) {
            $values['id'] = $post->id()->asInt();
            $values['created_at'] = $now;

            $this->newQuery()->insert($values);

            $post->markAsPersisted();
        } else {
            $this->newQuery()->where('id', $post->id()->asInt())->update($values);
        }
    }

    private function newQuery(): Builder
    {
        return $this->db->table('posts');
    }
}

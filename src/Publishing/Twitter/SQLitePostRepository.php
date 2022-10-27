<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Illuminate\Database\SQLiteConnection;
use stdClass;

final class SQLitePostRepository implements PostRepository
{
    public function __construct(
        private readonly SQLiteConnection $db,
    ) {}

    public function find(int $id): Post
    {
        /** @var stdClass|null $post */
        $post = $this->db->table('posts')->find($id, ['slug', 'title']);

        if (is_null($post)) {
            throw CouldNotFindPost::withId($id);
        }

        $tags = $this->db
            ->table('tags')
            ->whereIn('id', $this->db->table('post_tag')->where('post_id', $id)->select('tag_id'))
            ->pluck('slug')
            ->all();

        return new Post($post->title, $post->slug, $tags);
    }
}

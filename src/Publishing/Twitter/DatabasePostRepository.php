<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Publishing\Twitter\Exceptions\CouldNotFindPost;
use Illuminate\Database\ConnectionInterface;
use stdClass;

final class DatabasePostRepository implements PostRepository
{
    public function __construct(
        private readonly ConnectionInterface $db,
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

        return Post::make($post->title, $post->slug, $tags);
    }
}

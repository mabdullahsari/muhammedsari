<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Illuminate\Database\SQLiteConnection;
use stdClass;

final readonly class SQLitePublishedPostProvider implements PublishedPostProvider
{
    public function __construct(private SQLiteConnection $db) {}

    public function getById(int $id): PublishedPost
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

        return new PublishedPost($post->title, $post->slug, $tags);
    }
}

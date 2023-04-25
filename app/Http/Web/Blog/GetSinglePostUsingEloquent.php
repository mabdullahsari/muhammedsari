<?php declare(strict_types=1);

namespace App\Http\Web\Blog;

use Blogging\Models\Post;
use Blogging\PostViewModel;

final readonly class GetSinglePostUsingEloquent implements GetSinglePost
{
    private const COLUMNS = ['body', 'id', 'published_at', 'slug', 'summary', 'title'];

    public function __construct(private Post $model) {}

    /** @throws CouldNotGetPost */
    public function get(string $slug): PostViewModel
    {
        $post = $this->model
            ->newQuery()
            ->where('slug', $slug)
            ->with('tags')
            ->first(self::COLUMNS);

        if (! $post instanceof Post) {
            throw CouldNotGetPost::withSlug($slug);
        }

        return PostViewModel::fromEloquent($post);
    }
}

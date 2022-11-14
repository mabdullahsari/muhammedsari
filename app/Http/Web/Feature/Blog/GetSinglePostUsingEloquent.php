<?php declare(strict_types=1);

namespace App\Http\Web\Feature\Blog;

use Core\Blogging\Models\Post;
use Core\Blogging\PostViewModel;

final readonly class GetSinglePostUsingEloquent implements GetSinglePost
{
    public function __construct(
        private Post $model,
    ) {}

    /** @throws CouldNotGetPost */
    public function get(string $slug): PostViewModel
    {
        $post = $this->model
            ->newQuery()
            ->where('slug', $slug)
            ->with('tags:slug')
            ->first(['body', 'id', 'published_at', 'slug', 'summary', 'title']);

        if (! $post instanceof Post) {
            throw CouldNotGetPost::withSlug($slug);
        }

        return $this->map($post);
    }

    private function map(Post $post): PostViewModel
    {
        return new PostViewModel(
            $post->body,
            $post->published_at,
            $post->slug,
            $post->summary,
            $post->tags->pluck('slug')->all(),
            $post->title,
        );
    }
}

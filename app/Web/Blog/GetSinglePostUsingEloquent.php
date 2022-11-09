<?php declare(strict_types=1);

namespace App\Web\Blog;

use Core\Blogging\Models\Post;
use Core\Blogging\PostViewModel;

final readonly class GetSinglePostUsingEloquent implements GetSinglePost
{
    public function __construct(
        private Post $model,
    ) {}

    public function get(string $slug): ?PostViewModel
    {
        $post = $this->model
            ->newQuery()
            ->where('slug', $slug)
            ->where('state', 'published')
            ->with('tags:id,slug')
            ->first(['body', 'id', 'published_at', 'slug', 'summary', 'title']);

        return $post instanceof Post ? $this->map($post) : null;
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

<?php declare(strict_types=1);

namespace App\Web\Feature\Blog;

use Core\Blogging\Models\Post;
use Core\Blogging\PostSummaryViewModel;
use Illuminate\Support\Collection;

final readonly class GetMyPostsUsingEloquent implements GetMyPosts
{
    public function __construct(
        private Post $model,
    ) {}

    public function get(): Collection
    {
        return $this->model
            ->newQuery()
            ->latest('published_at')
            ->where('state', 'published')
            ->get(['published_at', 'slug', 'summary', 'title'])
            ->map($this->mapper(...))
            ->toBase();
    }

    private function mapper(Post $post): PostSummaryViewModel
    {
        return new PostSummaryViewModel(
            $post->published_at,
            $post->slug,
            $post->summary,
            $post->title,
        );
    }
}

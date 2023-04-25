<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetMyPosts;
use Blogging\Contract\PostSummary;
use Blogging\Models\MustBePublished;
use Blogging\Models\Post;
use Blogging\Models\SortByPublicationDate;
use Illuminate\Support\Collection;

final readonly class GetMyPostsUsingEloquent implements GetMyPosts
{
    private const COLUMNS = ['published_at', 'slug', 'summary', 'title'];

    public function __construct(private Post $model) {}

    public function get(): Collection
    {
        return $this->model->newQuery()
            ->tap(new SortByPublicationDate())
            ->tap(new MustBePublished())
            ->get(self::COLUMNS)
            ->map($this->asViewModel(...))
            ->toBase();
    }

    private function asViewModel(Post $post): PostSummary
    {
        return new PostSummary($post->published_at, $post->slug, $post->summary, $post->title);
    }
}

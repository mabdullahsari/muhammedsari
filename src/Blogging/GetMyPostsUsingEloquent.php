<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetMyPosts;
use Blogging\Contract\PostSummary;
use Illuminate\Support\Collection;
use Blogging\Contract\Tag as TagViewModel;

final readonly class GetMyPostsUsingEloquent implements GetMyPosts
{
    public function __construct(private Post $model) {}

    public function get(): Collection
    {
        return $this->model->newQuery()
            ->with('tags')
            ->where('state', PostState::Published)
            ->latest('published_at')
            ->get(['id', 'published_at', 'slug', 'summary', 'title'])
            ->map(static function (Post $p) {
                return new PostSummary(
                    $p->published_at,
                    $p->slug,
                    $p->summary,
                    $p->tags->map(static fn (Tag $t) => new TagViewModel($t->slug, $t->name))->all(),
                    $p->title,
                );
            });
    }
}

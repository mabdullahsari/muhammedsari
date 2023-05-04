<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetMyPostsByTag;
use Blogging\Contract\PostSummary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Blogging\Contract\Tag as TagViewModel;

final readonly class GetMyPostsByTagUsingEloquent implements GetMyPostsByTag
{
    public function __construct(private Post $model) {}

    public function get(TagViewModel $tag): Collection
    {
        return $this->model->newQuery()
            ->whereHas('tags', static fn (Builder $builder) => $builder->where('slug', $tag->slug))
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

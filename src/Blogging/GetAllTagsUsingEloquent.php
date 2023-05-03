<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetAllTags;
use Blogging\Contract\Tag as TagViewModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final readonly class GetAllTagsUsingEloquent implements GetAllTags
{
    public function __construct(private Tag $model) {}

    public function get(): Collection
    {
        return $this->model->newQuery()
            ->orderBy('name')
            ->whereHas('posts', static fn (Builder $query) => $query->where('state', PostState::Published))
            ->get()
            ->map(static fn (Tag $t) => new TagViewModel($t->slug, $t->name));
    }
}

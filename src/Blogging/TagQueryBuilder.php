<?php declare(strict_types=1);

namespace Blogging;

use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass of Tag
 *
 * @extends Builder<TModelClass>
 */
final class TagQueryBuilder extends Builder
{
    public function hasPublishedPosts(): self
    {
        return $this->whereHas('posts', static fn (Builder $query) => $query->where('state', PostState::Published));
    }

    public function sortAlphabetically(): self
    {
        return $this->orderBy('name');
    }
}

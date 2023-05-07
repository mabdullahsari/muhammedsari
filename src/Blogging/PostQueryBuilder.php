<?php declare(strict_types=1);

namespace Blogging;

use Illuminate\Database\Eloquent\Builder;

final class PostQueryBuilder extends Builder
{
    public function hasSlug(string $slug): self
    {
        return $this->where('slug', $slug);
    }

    public function hasTag(string $tag): self
    {
        return $this->whereHas('tags', static fn (Builder $builder) => $builder->where('slug', $tag));
    }

    public function isPublished(): self
    {
        return $this->where('state', PostState::Published);
    }

    public function mostRecentFirst(): self
    {
        return $this->latest('published_at');
    }
}

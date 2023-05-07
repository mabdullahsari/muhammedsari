<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\Tag;
use Blogging\Tag as TagModel;
use Illuminate\Support\Collection;

final readonly class TagQueryBusUsingEloquent implements TagQueryBus
{
    public function __construct(private TagQueryBuilder $query) {}

    public function get(): Collection
    {
        return $this->query
            ->newQuery()
            ->sortAlphabetically()
            ->hasPublishedPosts()
            ->get()
            ->map(static fn (TagModel $t) => new Tag($t->slug, $t->name));
    }

    /** @throws CouldNotFindTag */
    public function findBySlug(string $slug): Tag
    {
        $tag = $this->query->newQuery()->where('slug', $slug)->first();

        if (! $tag instanceof TagModel) {
            throw CouldNotFindTag::withSlug($slug);
        }

        return new Tag($tag->slug, $tag->name);
    }
}

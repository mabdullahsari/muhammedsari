<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetSingleTag;
use Blogging\Contract\Tag as TagViewModel;

final readonly class GetSingleTagUsingEloquent implements GetSingleTag
{
    public function __construct(private Tag $model) {}

    /** @throws CouldNotFindTag */
    public function get(string $slug): TagViewModel
    {
        $tag = $this->model->newQuery()->where('slug', $slug)->first();

        if (! $tag instanceof Tag) {
            throw CouldNotFindTag::withSlug($slug);
        }

        return new TagViewModel($tag->slug, $tag->name);
    }
}

<?php declare(strict_types=1);

namespace Blogging\Contract;

use Illuminate\Support\Collection;

interface GetMyPostsByTag
{
    /** @return Collection<int, PostSummary> */
    public function get(Tag $tag): Collection;
}

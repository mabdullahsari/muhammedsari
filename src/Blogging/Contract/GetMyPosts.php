<?php declare(strict_types=1);

namespace Blogging\Contract;

use Illuminate\Support\Collection;

interface GetMyPosts
{
    /** @return Collection<int, PostSummary> */
    public function get(): Collection;
}

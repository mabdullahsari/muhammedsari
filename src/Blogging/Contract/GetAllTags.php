<?php

namespace Blogging\Contract;

use Illuminate\Support\Collection;

interface GetAllTags
{
    /** @return Collection<int, Tag> */
    public function get(): Collection;
}

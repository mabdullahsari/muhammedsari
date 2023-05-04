<?php declare(strict_types=1);

namespace Blogging\Contract;

use Blogging\CouldNotFindTag;

interface GetSingleTag
{
    /** @throws CouldNotFindTag */
    public function get(string $slug): Tag;
}

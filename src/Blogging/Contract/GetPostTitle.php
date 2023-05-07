<?php declare(strict_types=1);

namespace Blogging\Contract;

use Blogging\CouldNotFindPost;

interface GetPostTitle
{
    /** @throws CouldNotFindPost */
    public function getTitleBySlug(string $slug): string;
}

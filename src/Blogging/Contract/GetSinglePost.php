<?php declare(strict_types=1);

namespace Blogging\Contract;

use Blogging\CouldNotFindPost;

interface GetSinglePost
{
    /** @throws CouldNotFindPost */
    public function findBySlug(string $slug): Post;
}

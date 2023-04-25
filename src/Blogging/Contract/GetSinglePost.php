<?php declare(strict_types=1);

namespace Blogging\Contract;

interface GetSinglePost
{
    /** @throws CouldNotFindPost */
    public function get(string $slug): Post;
}

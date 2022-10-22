<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Publishing\Twitter\Exceptions\CouldNotFindPost;

interface PostRepository
{
    /** @throws CouldNotFindPost */
    public function find(int $id): Post;
}

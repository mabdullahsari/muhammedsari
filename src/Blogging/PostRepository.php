<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Blogging\Exceptions\CouldNotFindPost;

interface PostRepository
{
    /** @throws CouldNotFindPost */
    public function find(int $id): Post;

    public function save(Post $post): void;
}

<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\CouldNotFindPost;

interface PostRepository
{
    /** @throws CouldNotFindPost */
    public function find(PostId $id): Post;

    public function save(Post $post): void;
}

<?php declare(strict_types=1);

namespace Core\Blogging;

interface PostRepository
{
    /** @throws CouldNotFindPost */
    public function find(PostId $id): Post;

    public function save(Post $post): void;
}

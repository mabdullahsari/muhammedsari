<?php declare(strict_types=1);

namespace Domain\Blogging;

interface PostRepository
{
    /** @throws CouldNotFindPost */
    public function find(int $id): Post;

    public function save(Post $post): void;
}

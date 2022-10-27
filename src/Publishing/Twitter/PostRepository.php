<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

interface PostRepository
{
    /** @throws CouldNotFindPost */
    public function find(int $id): Post;
}

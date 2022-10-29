<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

interface PostProvider
{
    /** @throws CouldNotFindPost */
    public function getById(int $id): Post;
}

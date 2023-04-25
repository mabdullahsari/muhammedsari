<?php declare(strict_types=1);

namespace Publishing\Twitter;

interface PublishedPostProvider
{
    /** @throws CouldNotFindPost */
    public function getById(int $id): PublishedPost;
}

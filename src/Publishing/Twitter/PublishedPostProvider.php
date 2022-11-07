<?php declare(strict_types=1);

namespace Core\Publishing\Twitter;

interface PublishedPostProvider
{
    /** @throws CouldNotFindPost */
    public function getById(int $id): PublishedPost;
}

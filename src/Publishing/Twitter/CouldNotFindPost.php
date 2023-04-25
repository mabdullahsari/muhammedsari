<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Exception;

final class CouldNotFindPost extends Exception
{
    public static function withId(int $id): self
    {
        return new self("Couldn't find Post with id {$id}");
    }
}

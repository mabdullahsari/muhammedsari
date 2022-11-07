<?php declare(strict_types=1);

namespace Core\Blogging;

use Exception;

final class CouldNotFindPost extends Exception
{
    public static function withId(PostId $id): self
    {
        return new self("Couldn't find Post with id {$id->asInt()}");
    }
}

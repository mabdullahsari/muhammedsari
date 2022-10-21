<?php declare(strict_types=1);

namespace Domain\Scheduling\Exceptions;

use Exception;

final class CouldNotFindEntry extends Exception
{
    public static function withId(int $id): self
    {
        return new self("Couldn't find Entry with id {$id}");
    }

    public static function withPostId(int $id): self
    {
        return new self("Couldn't find Entry with PostId {$id}");
    }
}

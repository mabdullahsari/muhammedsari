<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Exception;

final class CouldNotFindPublication extends Exception
{
    public static function withId(int $id): self
    {
        return new self("Couldn't find Publication with id {$id}");
    }

    public static function withPostId(int $id): self
    {
        return new self("Couldn't find Publication with PostId {$id}");
    }
}

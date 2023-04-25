<?php declare(strict_types=1);

namespace Core\Contract\Blogging\Event;

final readonly class PostWasDeleted
{
    public function __construct(public int $id) {}
}

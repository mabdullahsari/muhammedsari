<?php declare(strict_types=1);

namespace Blogging\Contract;

final readonly class PostDeleted
{
    public function __construct(public int $id) {}
}

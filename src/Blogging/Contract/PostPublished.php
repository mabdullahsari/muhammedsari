<?php declare(strict_types=1);

namespace Blogging\Contract;

final readonly class PostPublished
{
    public function __construct(public int $id) {}
}

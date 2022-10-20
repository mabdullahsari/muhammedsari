<?php declare(strict_types=1);

namespace Domain\Blogging\Contracts\Commands;

use Dive\Utils\Makeable;

final class PublishPost
{
    use Makeable;

    public function __construct(
        public readonly int $id,
    ) {}
}

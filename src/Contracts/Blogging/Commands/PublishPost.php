<?php declare(strict_types=1);

namespace Domain\Contracts\Blogging\Commands;

use Dive\Utils\Makeable;
use Illuminate\Contracts\Queue\ShouldQueue;

final class PublishPost implements ShouldQueue
{
    use Makeable;

    public function __construct(
        public readonly int $id,
    ) {}
}

<?php declare(strict_types=1);

namespace Domain\Contracts\Blogging\Commands;

use Illuminate\Contracts\Queue\ShouldQueue;

final class PublishPost implements ShouldQueue
{
    public function __construct(
        public readonly int $id,
    ) {}
}

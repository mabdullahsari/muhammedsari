<?php declare(strict_types=1);

namespace Core\Contract\Blogging\Command;

use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class PublishPost implements ShouldQueue
{
    public function __construct(public int $id) {}
}

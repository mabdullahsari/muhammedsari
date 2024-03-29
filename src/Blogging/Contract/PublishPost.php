<?php declare(strict_types=1);

namespace Blogging\Contract;

use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class PublishPost implements ShouldQueue
{
    public function __construct(public int $id) {}
}

<?php declare(strict_types=1);

namespace PreventingSpam\Contract;

use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class ExecuteAnyway implements ShouldQueue
{
    public function __construct(public int $id) {}
}

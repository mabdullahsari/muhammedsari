<?php declare(strict_types=1);

namespace Scheduling;

use Illuminate\Foundation\Bus\Dispatchable;

final readonly class CancelPublication
{
    use Dispatchable;

    public function __construct(private int $postId) {}

    public function handle(Publication $publications): void
    {
        $publications->cancel($this->postId);
    }
}

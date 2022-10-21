<?php declare(strict_types=1);

namespace App\Foundation\Bus;

use Closure;
use Illuminate\Database\ConnectionInterface;

final class UseDatabaseTransactions
{
    public function __construct(
        private readonly ConnectionInterface $db,
    ) {}

    public function handle(object $command, Closure $next): mixed
    {
        return $this->db->transaction(static fn () => $next($command));
    }
}

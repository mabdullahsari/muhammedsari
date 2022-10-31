<?php declare(strict_types=1);

namespace App\Foundation\Bus;

use Closure;
use Illuminate\Database\SQLiteConnection;

final class UseDatabaseTransactions
{
    public function __construct(
        private readonly SQLiteConnection $db,
    ) {}

    public function handle(object $command, Closure $next): mixed
    {
        return $this->db->transaction(static fn () => $next($command));
    }
}

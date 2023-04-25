<?php declare(strict_types=1);

namespace App\Foundation;

use Closure;
use Illuminate\Database\SQLiteConnection;

final readonly class UseDatabaseTransactions
{
    public function __construct(private SQLiteConnection $db) {}

    public function handle(object $command, Closure $next): mixed
    {
        return $this->db->transaction(static fn () => $next($command));
    }
}

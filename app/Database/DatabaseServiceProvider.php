<?php declare(strict_types=1);

namespace App\Database;

use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

final class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SQLiteConnection::class,
            static fn (Application $app) => $app['db']->connection('sqlite')
        );

        $this->app->resolving(Dispatcher::class, $this->configureBus(...));
    }

    private function configureBus(): void
    {
        $this->app[Repository::class]->push('bus.pipes', UseDatabaseTransactions::class);
    }
}

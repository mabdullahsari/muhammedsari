<?php declare(strict_types=1);

namespace Database;

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
    }
}

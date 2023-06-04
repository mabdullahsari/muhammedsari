<?php declare(strict_types=1);

namespace PreservingData;

use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;
use PreservingData\Contract\BackUpDatabase;

final class PreservingDataServiceProvider extends ServiceProvider
{
    private const TABLES = ['blogging_posts', 'blogging_tags', 'blogging_post_tag'];

    public function register(): void
    {
        $this->app->singleton(BackupStore::class, $this->createBackupStore(...));;
        $this->app->singleton(DatabaseDumper::class, $this->createDatabaseDumper(...));;

        $this->app->resolving(Dispatcher::class, $this->registerHandlers(...));
    }

    private function createBackupStore(): BackupStore
    {
        return $this->app->isProduction()
            ? new VersionControlBackupStore($this->app->storagePath('app'))
            : new NullBackupStore();
    }

    private function createDatabaseDumper(): DatabaseDumper
    {
        return $this->app->isProduction()
            ? new Sqlite3DatabaseDumper($this->app['config']['database.connections.sqlite.database'], self::TABLES)
            : new EmptyDatabaseDumper();
    }

    private function registerHandlers(Dispatcher $commands): void
    {
        $commands->map([BackUpDatabase::class => BackUpDatabaseHandler::class]);
    }
}

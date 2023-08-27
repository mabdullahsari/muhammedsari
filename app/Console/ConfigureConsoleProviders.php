<?php declare(strict_types=1);

namespace App\Console;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;

final readonly class ConfigureConsoleProviders
{
    public function bootstrap(Application $app): void
    {
        $providers = ServiceProvider::defaultProviders()->merge([ConsoleServiceProvider::class])->toArray();

        $app[Repository::class]->set('app.providers', $providers);
    }
}

<?php declare(strict_types=1);

namespace App\UserInterface\Console;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\DefaultProviders;

final readonly class ConfigureConsoleProviders
{
    public function bootstrap(Application $app): void
    {
        $providers = (new DefaultProviders())->merge([ConsoleServiceProvider::class])->toArray();

        $app[Repository::class]->set('app.providers', $providers);
    }
}

<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\DefaultProviders;

final readonly class LoadConsoleProvider
{
    private const PROVIDER = ConsoleServiceProvider::class;

    public function bootstrap(Application $app): void
    {
        /** @var Repository $config */
        $config = $app->get('config');

        $config->set('app.providers', (new DefaultProviders())->merge([self::PROVIDER])->toArray());
    }
}

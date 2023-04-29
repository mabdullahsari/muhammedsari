<?php declare(strict_types=1);

namespace App\Http;

use App\Http\Admin\AdminServiceProvider;
use App\Http\Web\WebServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\DefaultProviders;

final readonly class LoadUserInterfaceProvider
{
    public function bootstrap(Application $app): void
    {
        /** @var Repository $config */
        $config = $app->get('config');

        /** @var Request $httpContext */
        $httpContext = $app->get('request');
        $path = ltrim($httpContext->getPathInfo(), DIRECTORY_SEPARATOR);

        $config->set('app.providers', (new DefaultProviders())->merge(match (true) {
            $this->wantsAdmin($path, $config) => [AdminServiceProvider::class],
            default => [WebServiceProvider::class],
        })->toArray());
    }

    private function wantsAdmin(string $path, Repository $config): bool
    {
        return str_starts_with($path, $config->get('filament.path'))
            || str_starts_with($path, $config->get('filament.core_path'))
            || str_starts_with($path, 'livewire');
    }
}

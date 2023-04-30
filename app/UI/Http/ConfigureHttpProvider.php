<?php declare(strict_types=1);

namespace App\UI\Http;

use App\UI\Http\Admin\AdminServiceProvider;
use App\UI\Http\Site\SiteServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\DefaultProviders;

final readonly class ConfigureHttpProvider
{
    public function bootstrap(Application $app): void
    {
        $path = ltrim($app[Request::class]->getPathInfo(), DIRECTORY_SEPARATOR);

        $config = $app[Repository::class];

        $providers = (new DefaultProviders())->merge(match (true) {
            $this->wantsAdmin($path, $config) => [AdminServiceProvider::class],
            default => [SiteServiceProvider::class],
        })->toArray();

        $config->set('app.providers', $providers);
    }

    private function wantsAdmin(string $path, Repository $config): bool
    {
        return str_starts_with($path, $config->get('filament.path'))
            || str_starts_with($path, $config->get('filament.core_path'))
            || str_starts_with($path, 'livewire');
    }
}
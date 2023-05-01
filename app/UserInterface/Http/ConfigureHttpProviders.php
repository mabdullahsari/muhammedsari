<?php declare(strict_types=1);

namespace App\UserInterface\Http;

use App\UserInterface\Http\Admin\AdminServiceProvider;
use App\UserInterface\Http\Site\SiteServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\DefaultProviders;

final readonly class ConfigureHttpProviders
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

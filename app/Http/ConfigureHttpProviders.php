<?php declare(strict_types=1);

namespace App\Http;

use App\Http\Admin\AdminServiceProvider;
use App\Http\Health\CheckHealthController;
use App\Http\Health\HealthServiceProvider;
use App\Http\Horizon\HorizonServiceProvider;
use App\Http\Site\SiteServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

final readonly class ConfigureHttpProviders
{
    public function bootstrap(Application $app): void
    {
        $path = $app[Request::class]->path();

        $config = $app[Repository::class];

        $providers = ServiceProvider::defaultProviders()->merge(match (true) {
            $this->wantsAdmin($path, $config) => [AdminServiceProvider::class],
            $this->wantsHealth($path) => [HealthServiceProvider::class],
            $this->wantsHorizon($path, $config) => [HorizonServiceProvider::class],
            default => [SiteServiceProvider::class],
        })->toArray();

        $config->set('app.providers', $providers);
    }

    private function wantsAdmin(string $path, Repository $config): bool
    {
        return str_starts_with($path, $config->get('filament.path')) || str_starts_with($path, 'livewire');
    }

    private function wantsHealth(string $path): bool
    {
        return $path === CheckHealthController::ROUTE;
    }

    private function wantsHorizon(string $path, Repository $config): bool
    {
        return str_starts_with($path, $config->get('horizon.path'));
    }
}

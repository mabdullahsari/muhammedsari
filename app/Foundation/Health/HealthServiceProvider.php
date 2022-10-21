<?php declare(strict_types=1);

namespace App\Foundation\Health;

use Illuminate\Support\AggregateServiceProvider;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Health;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;

final class HealthServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\Health\HealthServiceProvider::class,
    ];

    public function register(): void
    {
        parent::register();

        $this->app->afterResolving('health', $this->registerChecks(...));
    }

    private function registerChecks(Health $health): void
    {
        $health->checks([
            CacheCheck::new(),
            DatabaseCheck::new(),
            DebugModeCheck::new(),
            ScheduleCheck::new(),
            UsedDiskSpaceCheck::new(),
            OptimizedAppCheck::new()->checkConfig()->checkRoutes(),
            SecurityAdvisoriesCheck::new(),
        ]);
    }
}

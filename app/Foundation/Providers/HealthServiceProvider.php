<?php declare(strict_types=1);

namespace App\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Health;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;

final class HealthServiceProvider extends ServiceProvider
{
    public function boot(Health $health): void
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

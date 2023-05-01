<?php declare(strict_types=1);

namespace App\UserInterface\Http\Admin\General;

use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

final class ApplicationHealth extends HealthCheckResults
{
    protected static function getNavigationGroup(): null
    {
        return null;
    }
}

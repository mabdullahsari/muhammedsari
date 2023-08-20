<?php declare(strict_types=1);

namespace App\Http\Admin\General;

use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

final class ApplicationHealth extends HealthCheckResults
{
    public static function getNavigationGroup(): null
    {
        return null;
    }
}

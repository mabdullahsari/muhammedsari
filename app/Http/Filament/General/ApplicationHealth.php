<?php declare(strict_types=1);

namespace App\Http\Filament\General;

use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

final class ApplicationHealth extends HealthCheckResults
{
    protected static function getNavigationGroup(): null
    {
        return null;
    }
}

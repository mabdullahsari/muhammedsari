<?php declare(strict_types=1);

namespace App\Filament;

use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

final class HealthCheckResultsPage extends HealthCheckResults
{
    protected static ?int $navigationSort = 6;

    protected static ?string $slug = 'application-health';
}

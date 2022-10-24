<?php declare(strict_types=1);

namespace App\Filament\Pages;

use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

final class HealthCheckResultsPage extends HealthCheckResults
{
    protected static ?int $navigationSort = 5;

    protected static ?string $slug = 'application-health';
}

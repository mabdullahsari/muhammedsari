<?php declare(strict_types=1);

namespace App\Filament\General;

use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

final class Health extends HealthCheckResults
{
    protected static ?int $navigationSort = 0;

    protected static ?string $slug = 'health';

    protected function getHeading(): string
    {
        return 'Health';
    }

    protected static function getNavigationLabel(): string
    {
        return 'Health';
    }

    protected static function getNavigationGroup(): null
    {
        return null;
    }
}

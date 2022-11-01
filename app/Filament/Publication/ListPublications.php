<?php declare(strict_types=1);

namespace App\Filament\Publication;

use App\Filament\Publication;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListPublications extends ListRecords
{
    protected static string $resource = Publication::class;

    protected function getActions(): array
    {
        return [CreateAction::make()->label('Schedule')];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

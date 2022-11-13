<?php declare(strict_types=1);

namespace App\Filament\Feature\Showcase\Resource;

use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListResources extends ListRecords
{
    protected static string $resource = Resource::class;

    protected function getActions(): array
    {
        return [CreateAction::make()];
    }

    protected function getTableReorderColumn(): string
    {
        return 'sort';
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

<?php declare(strict_types=1);

namespace App\Http\Admin\Blog\Tag;

use App\Http\Admin\Blog\DatabaseBackup;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListTags extends ListRecords
{
    protected static string $resource = Tag::class;

    protected function getHeaderActions(): array
    {
        return [DatabaseBackup::make(), CreateAction::make()->icon('heroicon-s-plus')];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

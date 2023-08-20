<?php declare(strict_types=1);

namespace App\Http\Admin\Blog\Post;

use App\Http\Admin\Blog\DatabaseBackup;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListPosts extends ListRecords
{
    protected static string $resource = Post::class;

    protected function getHeaderActions(): array
    {
        return [DatabaseBackup::make(), CreateAction::make()->icon('heroicon-s-plus')];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

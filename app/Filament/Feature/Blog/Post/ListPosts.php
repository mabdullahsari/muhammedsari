<?php declare(strict_types=1);

namespace App\Filament\Feature\Blog\Post;

use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListPosts extends ListRecords
{
    protected static string $resource = Post::class;

    protected function getActions(): array
    {
        return [CreateAction::make()];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

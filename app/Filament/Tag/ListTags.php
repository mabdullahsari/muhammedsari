<?php declare(strict_types=1);

namespace App\Filament\Tag;

use App\Filament\Tag;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListTags extends ListRecords
{
    protected static string $resource = Tag::class;

    protected function getActions(): array
    {
        return [CreateAction::make()];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

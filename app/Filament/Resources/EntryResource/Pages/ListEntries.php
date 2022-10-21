<?php declare(strict_types=1);

namespace App\Filament\Resources\EntryResource\Pages;

use App\Filament\Resources\EntryResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListEntries extends ListRecords
{
    protected static string $resource = EntryResource::class;

    protected function getActions(): array
    {
        return [CreateAction::make()];
    }
}

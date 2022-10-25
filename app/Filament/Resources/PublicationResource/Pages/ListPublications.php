<?php declare(strict_types=1);

namespace App\Filament\Resources\PublicationResource\Pages;

use App\Filament\Resources\PublicationResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListPublications extends ListRecords
{
    protected static string $resource = PublicationResource::class;

    protected function getActions(): array
    {
        return [CreateAction::make()->label('Schedule')];
    }
}

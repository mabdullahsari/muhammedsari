<?php declare(strict_types=1);

namespace App\Filament\Resources\EntryResource\Pages;

use App\Filament\Resources\EntryResource;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

final class CreateEntry extends CreateRecord
{
    protected static bool $canCreateAnother = false;

    protected static string $resource = EntryResource::class;

    protected static ?string $title = 'Schedule Auto Publishing';

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()->label('Submit');
    }

    protected function getCreatedNotificationTitle(): string
    {
        return 'Scheduled';
    }
}

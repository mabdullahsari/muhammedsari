<?php declare(strict_types=1);

namespace App\Filament\Resources\PublicationResource\Pages;

use App\Filament\Resources\PublicationResource;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

final class SchedulePublication extends CreateRecord
{
    protected static ?string $breadcrumb = 'Schedule';

    protected static bool $canCreateAnother = false;

    protected static string $resource = PublicationResource::class;

    protected static ?string $title = 'Schedule Publication';

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()->label('Submit');
    }

    protected function getCreatedNotificationTitle(): string
    {
        return 'Scheduled';
    }
}

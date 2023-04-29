<?php declare(strict_types=1);

namespace App\Http\Admin\Schedule\Publication;

use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

final class SchedulePublication extends CreateRecord
{
    protected static ?string $breadcrumb = 'Schedule';

    protected static bool $canCreateAnother = false;

    protected static string $resource = Publication::class;

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

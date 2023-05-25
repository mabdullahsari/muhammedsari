<?php declare(strict_types=1);

namespace App\UserInterface\Http\Admin\SpamPrevention\Quarantine;

use Filament\Resources\Pages\ListRecords;

final class ListQuarantinedMessages extends ListRecords
{
    protected static string $resource = QuarantinedMessage::class;

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

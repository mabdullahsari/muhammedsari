<?php declare(strict_types=1);

namespace App\Filament\Showcase\Repository;

use Filament\Resources\Pages\EditRecord;

final class EditRepository extends EditRecord
{
    protected static string $resource = Repository::class;

    protected function getActions(): array
    {
        return [];
    }
}

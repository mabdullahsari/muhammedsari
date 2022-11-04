<?php declare(strict_types=1);

namespace App\Filament\Resource;

use App\Filament\Resource;
use Filament\Resources\Pages\EditRecord;

final class EditResource extends EditRecord
{
    protected static string $resource = Resource::class;

    protected function getActions(): array
    {
        return [];
    }
}
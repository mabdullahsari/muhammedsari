<?php declare(strict_types=1);

namespace App\Http\Filament\Feature\Showcase\Resource;

use Filament\Resources\Pages\EditRecord;

final class EditResource extends EditRecord
{
    protected static string $resource = Resource::class;

    protected function getActions(): array
    {
        return [];
    }
}

<?php declare(strict_types=1);

namespace App\Filament\Resources\EntryResource\Pages;

use App\Filament\Resources\EntryResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateEntry extends CreateRecord
{
    protected static string $resource = EntryResource::class;
}

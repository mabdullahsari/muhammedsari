<?php declare(strict_types=1);

namespace App\Filament\Resource;

use App\Filament\Resource;
use Filament\Resources\Pages\CreateRecord;

final class CreateResource extends CreateRecord
{
    protected static string $resource = Resource::class;
}

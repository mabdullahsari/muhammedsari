<?php declare(strict_types=1);

namespace App\Http\Filament\Feature\Showcase\Repository;

use Filament\Resources\Pages\CreateRecord;

final class CreateRepository extends CreateRecord
{
    protected static string $resource = Repository::class;
}

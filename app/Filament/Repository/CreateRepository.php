<?php declare(strict_types=1);

namespace App\Filament\Repository;

use App\Filament\Repository;
use Filament\Resources\Pages\CreateRecord;

final class CreateRepository extends CreateRecord
{
    protected static string $resource = Repository::class;
}

<?php declare(strict_types=1);

namespace App\Filament\User;

use App\Filament\User;
use Filament\Resources\Pages\ListRecords;

final class ListUsers extends ListRecords
{
    protected static string $resource = User::class;
}

<?php declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages\ListUsers;
use Domain\Identity\User;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Identity';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $slug = 'users';

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('email'),
            TextColumn::make('first_name'),
            TextColumn::make('last_name'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
        ];
    }
}

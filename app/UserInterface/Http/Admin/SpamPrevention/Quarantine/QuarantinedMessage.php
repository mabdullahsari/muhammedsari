<?php declare(strict_types=1);

namespace App\UserInterface\Http\Admin\SpamPrevention\Quarantine;

use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Identity\User;
use Illuminate\Support\Str;
use PreventingSpam\QuarantinedMessageReadModel;

final class QuarantinedMessage extends Resource
{
    protected static ?string $model = QuarantinedMessageReadModel::class;

    protected static ?string $navigationGroup = 'Spam Prevention';

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'spam-prevention/quarantine';

    public static function table(Table $table): Table
    {
        /** @var User $user */
        $user = Filament::auth()->user();

        return $table->columns([
            TextColumn::make('id')
                ->label('')
                ->formatStateUsing(fn ($record) => "#{$record->id}"),
            TextColumn::make('detection_method'),
            TextColumn::make('message_value')
                ->label('message')
                ->formatStateUsing(fn ($record) => Str::limit($record->message_value, 25))
                ->tooltip(fn ($record) => $record->message_type),
            TextColumn::make('quarantined_at')
                ->label('Quarantined At')
                ->dateTime(timezone: $user->timezone),
        ])->appendActions([
            Execute::make(),
        ]);
    }

    public static function getPluralModelLabel(): string
    {
        return 'Quarantine';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuarantinedMessages::route('/'),
        ];
    }
}

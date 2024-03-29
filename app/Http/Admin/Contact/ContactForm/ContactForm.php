<?php declare(strict_types=1);

namespace App\Http\Admin\Contact\ContactForm;

use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Identity\User;
use Illuminate\Support\Str;

final class ContactForm extends Resource
{
    protected static ?string $model = \Contacting\ContactForm::class;

    protected static ?string $navigationGroup = 'Contact';

    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'contact/form-submissions';

    public static function table(Table $table): Table
    {
        /** @var User $user */
        $user = Filament::auth()->user();

        return $table->columns([
            TextColumn::make('name')
                ->tooltip(fn ($record) => "{$record->email} - {$record->ip_address}"),
            TextColumn::make('message')
                ->formatStateUsing(fn ($record) => Str::limit($record->message, 50))
                ->tooltip(fn ($record) => $record->message),
            TextColumn::make('created_at')
                ->label('Submitted At')
                ->dateTime(timezone: $user->timezone),
        ])->actions([
            Reply::make(),
            DeleteAction::make(),
        ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) \Contacting\ContactForm::query()->count() ?: null;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Form submissions';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactForms::route('/'),
        ];
    }
}

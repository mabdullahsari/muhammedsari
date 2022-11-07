<?php declare(strict_types=1);

namespace App\Filament\Showcase\Repository;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;

final class Repository extends Resource
{
    protected static ?string $model = \Core\Showcasing\Repository::class;

    protected static ?string $navigationGroup = 'Showcase';

    protected static ?string $navigationIcon = 'heroicon-o-code';

    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'showcase/repositories';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->minLength(5)
                ->maxLength(255)
                ->required(),
            TextInput::make('url')
                ->maxLength(255)
                ->url()
                ->required(),
            Textarea::make('description')
                ->columnSpan(2)
                ->minLength(10)
                ->maxLength(255)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name'),
            TextColumn::make('description'),
        ])->actions([
            DeleteAction::make(),
            EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRepositories::route('/'),
            'create' => CreateRepository::route('/create'),
            'edit' => EditRepository::route('/{record}/edit'),
        ];
    }
}

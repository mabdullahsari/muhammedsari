<?php declare(strict_types=1);

namespace App\Filament\Showcase\Resource;

use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource as FilamentResource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;

final class Resource extends FilamentResource
{
    protected static ?string $model = \Core\Showcasing\Resource::class;

    protected static ?string $navigationGroup = 'Showcase';

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'showcase/resources';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('category')
                ->minLength(3)
                ->maxLength(255)
                ->required(),
            TextInput::make('name')
                ->minLength(5)
                ->maxLength(255)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('category'),
            TextColumn::make('name'),
        ])->actions([
            DeleteAction::make(),
            EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResources::route('/'),
            'create' => CreateResource::route('/create'),
            'edit' => EditResource::route('/{record}/edit'),
        ];
    }
}

<?php declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages\CreateTag;
use App\Filament\Resources\TagResource\Pages\EditTag;
use App\Filament\Resources\TagResource\Pages\ListTags;
use Domain\Blogging\Tag;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

final class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $navigationGroup = 'Blogging';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $slug = 'tags';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->reactive()
                ->required()
                ->afterStateUpdated(fn ($record, $set, $state) => ! $record && $set('slug', Str::slug($state))),
            TextInput::make('slug')
                ->disabled(static fn ($record) => $record instanceof Tag)
                ->required()
                ->unique(ignorable: static fn ($record) => $record),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('slug'),
            TextColumn::make('posts_count')
                ->label('# Posts')
                ->counts('posts')
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTags::route('/'),
            'create' => CreateTag::route('/create'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }
}

<?php declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use Domain\Blogging\Post;
use Domain\Blogging\PostState;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;
use Spatie\FilamentMarkdownEditor\MarkdownEditor;

final class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Blogging';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $slug = 'posts';

    public static function form(Form $form): Form
    {
        return $form->schema([
                TextInput::make('title')
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(static fn ($set, $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignorable: static fn ($record) => $record),
                MarkdownEditor::make('body')
                    ->columnSpan(2)
                    ->nullable(),
                TextInput::make('summary')
                    ->columnSpan(2)
                    ->nullable(),
                CheckboxList::make('tags')
                    ->required()
                    ->relationship('tags', 'name'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('author.full_name'),
            TextColumn::make('title')->searchable(),
            TextColumn::make('slug'),
            BadgeColumn::make('state')->colors([
                'primary' => static fn ($state) => PostState::Draft->equals($state),
                'success' => static fn ($state) => PostState::Published->equals($state),
            ]),
        ])->filters([
            SelectFilter::make('state')->options(array_flip(PostState::toArray())),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}

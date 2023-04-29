<?php declare(strict_types=1);

namespace App\UI\Http\Admin\Blog\Post;

use Blogging\PostState;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;
use Spatie\FilamentMarkdownEditor\MarkdownEditor;

final class Post extends Resource
{
    protected static ?string $model = \Blogging\Post::class;

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 0;

    protected static ?string $slug = 'blog/posts';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->reactive()
                ->required()
                ->afterStateUpdated(fn ($record, $set, $state) => ! $record?->isPublished() && $set('slug', Str::slug($state))),
            TextInput::make('slug')
                ->disabled(static fn ($record) => $record?->isPublished())
                ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                ->required()
                ->unique(ignorable: static fn ($record) => $record),
            MarkdownEditor::make('body')
                ->default('')
                ->columnSpan(2),
            TextInput::make('summary')
                ->default('')
                ->columnSpan(2)
                ->maxLength(100),
            CheckboxList::make('tags')
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
        ])->prependActions([
            DeleteAction::make(),
            PublishBlogPost::make(),
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

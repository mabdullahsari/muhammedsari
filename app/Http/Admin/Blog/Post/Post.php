<?php declare(strict_types=1);

namespace App\Http\Admin\Blog\Post;

use Blogging\PostState;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Identity\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

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
                ->required(fn ($record) => $record?->isPublished())
                ->default('')
                ->columnSpan(2),
            TextInput::make('summary')
                ->required(fn ($record) => $record?->isPublished())
                ->default('')
                ->columnSpan(2)
                ->maxLength(255),
            CheckboxList::make('tags')
                ->required(fn ($record) => $record?->isPublished())
                ->relationship('tags', 'name'),
        ]);
    }

    public static function table(Table $table): Table
    {
        /** @var User $user */
        $user = Filament::auth()->user();

        return $table->columns([
            TextColumn::make('id')->label('#'),
            TextColumn::make('title')->searchable(),
            BadgeColumn::make('state')->colors([
                'primary' => static fn ($state) => PostState::Draft->equals($state),
                'success' => static fn ($state) => PostState::Published->equals($state),
            ]),
            TextColumn::make('created_at')
                ->label('Created on')
                ->sortable()
                ->dateTime('F jS, Y', $user->timezone),
        ])->prependActions([
            DeleteAction::make(),
            PublishBlogPost::make()->visible(fn ($record) => $record->isPublishable()),
            ViewPost::make(),
        ])->filters([
            SelectFilter::make('state')->options(array_flip(PostState::toArray())),
        ])->defaultSort('created_at', 'desc');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('tags');
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

<?php declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Actions\PublishPostAction;
use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use Domain\Blogging\Models\Post;
use Domain\Blogging\ValueObjects\PostState;
use Domain\Blogging\ValueObjects\Slug;
use Domain\Blogging\ValueObjects\Summary;
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

final class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Blogging';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'posts';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->reactive()
                ->required()
                ->afterStateUpdated(fn ($record, $set, $state) => ! $record?->isPublished() && $set('slug', Str::slug($state))),
            TextInput::make('slug')
                ->disabled(static fn ($record) => $record?->isPublished())
                ->regex(Slug::REGEX)
                ->required()
                ->unique(ignorable: static fn ($record) => $record),
            MarkdownEditor::make('body')
                ->columnSpan(2)
                ->nullable(),
            TextInput::make('summary')
                ->columnSpan(2)
                ->nullable()
                ->maxLength(Summary::MAX_LENGTH),
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
        ])->prependActions([
            DeleteAction::make(),
            PublishPostAction::make(),
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

<?php declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\EntryResource\Pages\CreateEntry;
use App\Filament\Resources\EntryResource\Pages\ListEntries;
use Domain\Scheduling\Models\Entry;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

final class EntryResource extends Resource
{
    protected static ?string $model = Entry::class;

    protected static ?string $navigationGroup = 'Scheduling';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'entries';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('post_id')
                ->relationship('post', 'title', static fn (Builder $query) => $query->where('state', 'draft'))
                ->required(),
            DateTimePicker::make('publish_at')
                ->rule('after:today')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('post.title'),
            TextColumn::make('publish_at')->dateTime('d/m \o\m H\ui')->label('Publish At'),
        ])->prependActions([
            DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEntries::route('/'),
            'create' => CreateEntry::route('/create'),
        ];
    }
}

<?php declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\EntryResource\Pages\CreateEntry;
use App\Filament\Resources\EntryResource\Pages\ListEntries;
use Domain\Identity\Models\User;
use Domain\Scheduling\Models\Entry;
use Filament\Facades\Filament;
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
        /** @var User $user */
        $user = Filament::auth()->user();

        return $form->schema([
            Select::make('post_id')->relationship('post', 'title', static function (Builder $query) {
                $query->where('state', 'draft')->whereDoesntHave('entry');
            })->required(),
            DateTimePicker::make('publish_at')
                ->timezone($user->timezone)
                ->rule('after:today')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        /** @var User $user */
        $user = Filament::auth()->user();

        return $table->columns([
            TextColumn::make('post.title'),
            TextColumn::make('publish_at')
                ->dateTime(timezone: $user->timezone)
                ->label('Publish At'),
        ])->prependActions([
            DeleteAction::make()->modalHeading('Delete scheduled entry')
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

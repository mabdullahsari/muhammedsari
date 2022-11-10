<?php declare(strict_types=1);

namespace App\Filament\Schedule\Publication;

use Core\Identity\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

final class Publication extends Resource
{
    protected static ?string $model = \Core\Scheduling\Models\Publication::class;

    protected static ?string $navigationGroup = 'Schedule';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?int $navigationSort = 0;

    protected static ?string $slug = 'schedule/publications';

    public static function form(Form $form): Form
    {
        /** @var User $user */
        $user = Filament::auth()->user();

        return $form->schema([
            Select::make('post_id')->relationship('post', 'title', static function (Builder $query) {
                $query->where('state', 'draft')->whereDoesntHave('publication');
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
            DeleteAction::make()->modalHeading('Delete scheduled publication')
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPublications::route('/'),
            'create' => SchedulePublication::route('/create'),
        ];
    }
}

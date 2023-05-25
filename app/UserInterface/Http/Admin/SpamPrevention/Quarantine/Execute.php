<?php declare(strict_types=1);

namespace App\UserInterface\Http\Admin\SpamPrevention\Quarantine;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Bus;
use PreventingSpam\Contract\ExecuteAnyway;

final class Execute extends Action
{
    public static function getDefaultName(): string
    {
        return 'Execute anyway';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-s-cog');

        $this->requiresConfirmation();

        $this->color('danger');

        $this->action(function ($record) {
           Bus::dispatch(new ExecuteAnyway($record->id));
        });
    }
}

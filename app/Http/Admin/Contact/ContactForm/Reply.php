<?php declare(strict_types=1);

namespace App\Http\Admin\Contact\ContactForm;

use Filament\Tables\Actions\Action;

final class Reply extends Action
{
    public static function getDefaultName(): string
    {
        return 'reply';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-m-arrow-uturn-left');

        $this->url(fn ($record) => "mailto:{$record->email}");
    }
}

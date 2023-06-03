<?php declare(strict_types=1);

namespace App\Http\Admin\Blog\Post;

use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\URL;

final class ReadPost extends Action
{
    public static function getDefaultName(): string
    {
        return 'read';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Read');

        $this->icon('heroicon-s-external-link');

        $this->url(fn () => URL::to($this->livewire->record->slug), true);
    }
}

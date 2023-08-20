<?php declare(strict_types=1);

namespace App\Http\Admin\Blog\Post;

use Filament\Actions\Action;
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

        $this->icon('heroicon-m-arrow-top-right-on-square');

        $this->url(fn () => URL::to($this->livewire->record->slug), true);
    }
}

<?php declare(strict_types=1);

namespace App\UserInterface\Http\Admin\Blog\Post;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\URL;

final class ViewPost extends Action
{
    public static function getDefaultName(): string
    {
        return 'view';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('white');

        $this->icon('heroicon-s-eye');

        $this->label('View');

        $this->url(fn ($record) => URL::to($record->slug), true);
    }
}

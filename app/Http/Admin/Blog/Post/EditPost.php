<?php declare(strict_types=1);

namespace App\Http\Admin\Blog\Post;

use Filament\Resources\Pages\EditRecord;

final class EditPost extends EditRecord
{
    protected static string $resource = Post::class;

    protected function getActions(): array
    {
        return [ReadPost::make()];
    }
}

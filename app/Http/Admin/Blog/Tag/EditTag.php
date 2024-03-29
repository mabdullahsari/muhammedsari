<?php declare(strict_types=1);

namespace App\Http\Admin\Blog\Tag;

use Filament\Resources\Pages\EditRecord;

final class EditTag extends EditRecord
{
    protected static string $resource = Tag::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}

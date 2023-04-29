<?php declare(strict_types=1);

namespace App\UI\Http\Admin\Blog\Tag;

use Filament\Resources\Pages\CreateRecord;

final class CreateTag extends CreateRecord
{
    protected static string $resource = Tag::class;
}

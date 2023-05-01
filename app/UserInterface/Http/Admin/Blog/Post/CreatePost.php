<?php declare(strict_types=1);

namespace App\UserInterface\Http\Admin\Blog\Post;

use Filament\Resources\Pages\CreateRecord;

final class CreatePost extends CreateRecord
{
    protected static bool $canCreateAnother = false;

    protected static string $resource = Post::class;
}

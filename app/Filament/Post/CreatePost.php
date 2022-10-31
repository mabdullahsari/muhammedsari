<?php declare(strict_types=1);

namespace App\Filament\Post;

use App\Filament\Post;
use Filament\Resources\Pages\CreateRecord;

final class CreatePost extends CreateRecord
{
    protected static bool $canCreateAnother = false;

    protected static string $resource = Post::class;
}

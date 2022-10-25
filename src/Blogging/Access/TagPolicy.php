<?php declare(strict_types=1);

namespace Domain\Blogging\Access;

use Domain\Blogging\Models\Tag;
use Illuminate\Contracts\Auth\Authenticatable;

final class TagPolicy
{
    public function delete(Authenticatable $user, Tag $model): bool
    {
        return ! $model->posts_count;
    }

    public function deleteAny(Authenticatable $user): bool
    {
        return false;
    }
}

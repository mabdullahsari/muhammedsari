<?php declare(strict_types=1);

namespace Blogging;

use Illuminate\Contracts\Auth\Authenticatable;

final readonly class TagPolicy
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

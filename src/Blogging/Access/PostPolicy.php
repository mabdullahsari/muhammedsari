<?php declare(strict_types=1);

namespace Domain\Blogging\Access;

use Domain\Blogging\Models\Post;
use Illuminate\Contracts\Auth\Authenticatable;

final class PostPolicy
{
    public function delete(Authenticatable $user, Post $model): bool
    {
        return $model->isDraft();
    }

    public function deleteAny(Authenticatable $user): bool
    {
        return false;
    }

    public function publish(Authenticatable $user, Post $model): bool
    {
        return $model->isDraft();
    }
}

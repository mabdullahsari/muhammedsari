<?php declare(strict_types=1);

namespace Domain\Blogging;

use Illuminate\Contracts\Auth\Authenticatable;

final class TagPolicy
{
    public function delete(Authenticatable $user, Tag $model): bool
    {
        return $model->posts()->doesntExist();
    }

    public function deleteAny(Authenticatable $user): bool
    {
        return false;
    }
}

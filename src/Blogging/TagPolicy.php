<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Identity\User;

final class TagPolicy
{
    public function delete(User $user, Tag $model): bool
    {
        return $model->posts()->doesntExist();
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}

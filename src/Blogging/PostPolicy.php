<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Identity\User;

final class PostPolicy
{
    public function delete(User $user, Post $model): bool
    {
        return $model->isDraft();
    }
}

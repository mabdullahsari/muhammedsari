<?php declare(strict_types=1);

namespace Domain\Blogging;

use Illuminate\Contracts\Auth\Authenticatable;

final class PostPolicy
{
    public function delete(Authenticatable $user, Post $model): bool
    {
        return $model->isDraft();
    }
}

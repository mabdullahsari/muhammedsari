<?php declare(strict_types=1);

namespace Domain\Identity;

use Illuminate\Contracts\Auth\Authenticatable;

final class UserPolicy
{
    public function create(Authenticatable $user): bool
    {
        return false;
    }

    public function delete(Authenticatable $user, User $model): bool
    {
        return false;
    }

    public function deleteAny(Authenticatable $user): bool
    {
        return false;
    }

    public function update(Authenticatable $user, User $model): bool
    {
        return false;
    }

    public function view(Authenticatable $user, User $model): bool
    {
        return false;
    }

    public function viewAny(Authenticatable $user): bool
    {
        return true;
    }
}

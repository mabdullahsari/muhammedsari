<?php declare(strict_types=1);

namespace Domain\Identity;

final class UserPolicy
{
    public function create(User $user): bool
    {
        return false;
    }

    public function delete(User $user, User $model): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function update(User $user, User $model): bool
    {
        return false;
    }

    public function view(User $user, User $model): bool
    {
        return false;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }
}

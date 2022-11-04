<?php declare(strict_types=1);

namespace Domain\Showcasing;

use Illuminate\Contracts\Auth\Authenticatable;

final readonly class RepositoryPolicy
{
    public function deleteAny(Authenticatable $user): bool
    {
        return false;
    }
}

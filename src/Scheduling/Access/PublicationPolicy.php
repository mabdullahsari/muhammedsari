<?php declare(strict_types=1);

namespace Domain\Scheduling\Access;

use Illuminate\Contracts\Auth\Authenticatable;

final class PublicationPolicy
{
    public function deleteAny(Authenticatable $user): bool
    {
        return false;
    }
}

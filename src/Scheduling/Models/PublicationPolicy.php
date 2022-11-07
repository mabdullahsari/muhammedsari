<?php declare(strict_types=1);

namespace Core\Scheduling\Models;

use Illuminate\Contracts\Auth\Authenticatable;

final readonly class PublicationPolicy
{
    public function deleteAny(Authenticatable $user): bool
    {
        return false;
    }
}

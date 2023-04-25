<?php declare(strict_types=1);

namespace Scheduling\Models;

use Illuminate\Contracts\Auth\Authenticatable;

final readonly class PublicationPolicy
{
    public function deleteAny(Authenticatable $user): bool
    {
        return false;
    }
}

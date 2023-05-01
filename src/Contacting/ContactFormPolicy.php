<?php declare(strict_types=1);

namespace Contacting;

use Illuminate\Contracts\Auth\Authenticatable;

final readonly class ContactFormPolicy
{
    public function create(Authenticatable $user): bool
    {
        return false;
    }

    public function delete(Authenticatable $user, ContactForm $model): bool
    {
        return $this->deleteAny($user);
    }

    public function deleteAny(Authenticatable $user): bool
    {
        return true;
    }

    public function update(Authenticatable $user, ContactForm $odel): bool
    {
        return false;
    }
}

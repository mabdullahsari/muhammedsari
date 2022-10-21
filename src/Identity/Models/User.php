<?php declare(strict_types=1);

namespace Domain\Identity\Models;

use Dive\Eloquent\DisablesTimestamps;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 */
final class User extends Authenticatable implements FilamentUser
{
    use DisablesTimestamps;

    protected $fillable = ['email', 'first_name', 'last_name'];

    protected function name(): Attribute
    {
        return Attribute::get(fn () => "{$this->first_name} {$this->last_name}");
    }

    public function canAccessFilament(): bool
    {
        return true;
    }
}

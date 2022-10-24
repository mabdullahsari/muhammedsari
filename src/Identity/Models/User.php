<?php declare(strict_types=1);

namespace Domain\Identity\Models;

use Dive\Eloquent\DisablesTimestamps;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 * @property string $timezone
 * @property string $username
 */
final class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use DisablesTimestamps;

    protected $fillable = ['email', 'first_name', 'last_name', 'username'];

    protected function name(): Attribute
    {
        return Attribute::get(fn () => "{$this->first_name} {$this->last_name}");
    }

    public function canAccessFilament(): bool
    {
        return true;
    }

    public function getFilamentAvatarUrl(): string
    {
        return "https://unavatar.io/{$this->username}";
    }
}

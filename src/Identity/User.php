<?php declare(strict_types=1);

namespace Identity;

use Dive\Eloquent\DisablesTimestamps;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $avatar
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

    protected function avatar(): Attribute
    {
        return Attribute::get(fn () => "/img/{$this->username}.jpg");
    }

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
        return $this->avatar;
    }
}

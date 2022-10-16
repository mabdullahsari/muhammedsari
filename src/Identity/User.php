<?php declare(strict_types=1);

namespace Domain\Identity;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 */
final class User extends Model
{
    /** @var array<int, string> */
    protected $fillable = ['email', 'first_name', 'last_name'];

    /** @return Attribute<string, null> */
    protected function name(): Attribute
    {
        return Attribute::get(fn () => "{$this->first_name} {$this->last_name}");
    }
}

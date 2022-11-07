<?php declare(strict_types=1);

namespace Core\Blogging\Models;

use Dive\Eloquent\Unguarded;
use Dive\Eloquent\Unwritable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $first_name
 * @property string $full_name
 * @property string $last_name
 */
final class Author extends Model
{
    use Unguarded;
    use Unwritable;

    public const MUHAMMED = 1;

    protected $table = 'users';

    protected function fullName(): Attribute
    {
        return Attribute::get(fn () => "{$this->first_name} {$this->last_name}");
    }
}

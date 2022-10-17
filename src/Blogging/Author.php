<?php declare(strict_types=1);

namespace Domain\Blogging;

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

    final public const MUHAMMED = 1;

    protected $table = 'users';

    protected function fullName(): Attribute
    {
        return Attribute::get(fn () => "{$this->first_name} {$this->last_name}");
    }
}

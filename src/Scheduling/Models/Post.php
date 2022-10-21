<?php declare(strict_types=1);

namespace Domain\Scheduling\Models;

use Dive\Eloquent\Unguarded;
use Dive\Eloquent\Unwritable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 */
final class Post extends Model
{
    use Unguarded;
    use Unwritable;
}

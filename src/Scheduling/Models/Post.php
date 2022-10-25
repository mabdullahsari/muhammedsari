<?php declare(strict_types=1);

namespace Domain\Scheduling\Models;

use Dive\Eloquent\Unguarded;
use Dive\Eloquent\Unwritable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Publication|null $publication
 * @property string           $title
 */
final class Post extends Model
{
    use Unguarded;
    use Unwritable;

    public function publication(): HasOne
    {
        return $this->hasOne(Publication::class);
    }
}

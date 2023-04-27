<?php declare(strict_types=1);

namespace Scheduling\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Publication|null $publication
 * @property string           $title
 */
final class Post extends Model
{
    protected $table = 'blogging_posts';

    public function publication(): HasOne
    {
        return $this->hasOne(Publication::class);
    }
}

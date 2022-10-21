<?php declare(strict_types=1);

namespace Domain\Scheduling\Models;

use Dive\Eloquent\DisablesTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property Post   $post
 * @property Carbon $publish_at
 */
final class Entry extends Model
{
    use DisablesTimestamps;

    protected $dates = ['publish_at'];

    protected $fillable = ['post_id', 'publish_at'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}

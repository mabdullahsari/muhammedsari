<?php declare(strict_types=1);

namespace Scheduling\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Post            $post
 * @property CarbonImmutable $publish_at
 */
final class Publication extends Model
{
    protected $casts = ['publish_at' => 'immutable_datetime'];

    protected $fillable = ['post_id', 'publish_at'];

    protected $table = 'scheduling_publications';

    public $timestamps = false;

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}

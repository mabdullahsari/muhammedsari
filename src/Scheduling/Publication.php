<?php declare(strict_types=1);

namespace Scheduling;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * @property int             $id
 * @property Post            $post
 * @property int             $post_id
 * @property CarbonImmutable $publish_at
 */
final class Publication extends Model
{
    use HasFactory;

    protected $casts = ['publish_at' => 'immutable_datetime'];

    protected $fillable = ['post_id', 'publish_at'];

    protected $table = 'scheduling_publications';

    public $timestamps = false;

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function cancel(int $postId): void
    {
        $this->newQuery()->where($this->post()->getForeignKeyName(), $postId)->delete();
    }

    public function getUpcomingPosts(CarbonImmutable $now): Collection
    {
        return $this->newQuery()->tap(new Upcoming($now))->pluck('post_id');
    }

    protected static function newFactory(): PublicationFactory
    {
        return PublicationFactory::new();
    }
}

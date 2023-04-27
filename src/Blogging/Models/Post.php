<?php declare(strict_types=1);

namespace Blogging\Models;

use Carbon\CarbonImmutable;
use Blogging\PostState;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property Author               $author
 * @property string               $body
 * @property int                  $id
 * @property CarbonImmutable      $published_at
 * @property string               $slug
 * @property PostState            $state
 * @property string               $summary
 * @property Collection<int, Tag> $tags
 * @property string               $title
 */
final class Post extends Model
{
    protected $attributes = [
        'author_id' => Author::MUHAMMED,
        'state' => PostState::Draft,
    ];

    protected $casts = [
        'body' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'state' => PostState::class,
        'summary' => ConvertNullToEmptyString::class,
    ];

    protected $fillable = ['body', 'slug', 'summary', 'title'];

    protected $table = 'blogging_posts';

    public function isDraft(): bool
    {
        return $this->state->isDraft();
    }

    public function isPublished(): bool
    {
        return $this->state->isPublished();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blogging_post_tag');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

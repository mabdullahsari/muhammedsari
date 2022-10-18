<?php declare(strict_types=1);

namespace Domain\Blogging;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property Author               $author
 * @property string|null          $content
 * @property Carbon|null          $published_at
 * @property string               $slug
 * @property PostState            $state
 * @property string|null          $summary
 * @property Collection<int, Tag> $tags
 * @property string               $title
 */
final class Post extends Model
{
    protected $attributes = [
        'author_id' => Author::MUHAMMED,
        'state' => PostState::Draft,
    ];

    protected $casts = ['state' => PostState::class];

    protected $dates = ['published_at'];

    protected $fillable = ['content', 'slug', 'summary', 'title'];

    public function isDraft(): bool
    {
        return $this->state->isDraft();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}

<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\PostPublished;
use Carbon\CarbonImmutable;
use Clock\Contract\Clock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SharedKernel\RecordsEvents;

/**
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
    use HasFactory;
    use RecordsEvents;

    protected $attributes = [
        'author_id' => 1,
        'state' => PostState::Draft,
    ];

    protected $casts = [
        'body' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'state' => PostState::class,
        'summary' => ConvertNullToEmptyString::class,
    ];

    protected $guarded = [];

    protected $table = 'blogging_posts';

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blogging_post_tag');
    }

    /** @throws CouldNotFindPost */
    public function find(int $id): self
    {
        $post = $this->newQuery()->find($id);

        if (! $post instanceof self) {
            throw CouldNotFindPost::withId($id);
        }

        return $post;
    }

    public function isDraft(): bool
    {
        return $this->state->isDraft();
    }

    public function isPublishable(): bool
    {
        return $this->isDraft()
            && $this->summary
            && $this->body
            && ($this->attributes['tags_count'] ?? false);
    }

    public function isPublished(): bool
    {
        return $this->state->isPublished();
    }

    /** @throws CouldNotPublish */
    public function publish(Clock $clock): void
    {
        if ($this->isPublished()) {
            throw CouldNotPublish::becauseAlreadyPublished();
        } elseif (empty($this->summary)) {
            throw CouldNotPublish::becauseSummaryIsMissing();
        } elseif (empty($this->body)) {
            throw CouldNotPublish::becauseBodyIsMissing();
        } elseif ($this->tags->isEmpty()) {
            throw CouldNotPublish::becauseTagsAreMissing();
        }

        $this->attributes['published_at'] = $clock->now()->toDateTimeString();
        $this->attributes['state'] = PostState::Published->value;

        $this->recordThat(
            new PostPublished(
                $this->id,
                $this->slug,
                $this->tags->map(static fn (Tag $t) => $t->slug)->all(),
                $this->title,
            )
        );
    }

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }
}

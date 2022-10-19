<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Blogging\Casts\AsBody;
use Domain\Blogging\Casts\AsSlug;
use Domain\Blogging\Casts\AsSummary;
use Domain\Blogging\Contracts\Events\PostWasDeleted;
use Domain\Blogging\Contracts\Events\PostWasPublished;
use Domain\Blogging\Exceptions\CouldNotPublish;
use Domain\Blogging\ValueObjects\Body;
use Domain\Blogging\ValueObjects\PostState;
use Domain\Blogging\ValueObjects\Slug;
use Domain\Blogging\ValueObjects\Summary;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property Author               $author
 * @property Body                 $body
 * @property int                  $id
 * @property Carbon|null          $published_at
 * @property Slug                 $slug
 * @property PostState            $state
 * @property Summary              $summary
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
        'body' => AsBody::class,
        'slug' => AsSlug::class,
        'state' => PostState::class,
        'summary' => AsSummary::class,
    ];

    protected $dates = ['published_at'];

    protected $dispatchesEvents = [
        'deleted' => PostWasDeleted::class,
    ];

    protected $fillable = ['body', 'slug', 'summary', 'title'];

    public function isDraft(): bool
    {
        return $this->state->isDraft();
    }

    /** @throws CouldNotPublish */
    public function publish(): void
    {
        if ($this->state->isPublished()) {
            throw CouldNotPublish::becauseAlreadyPublished();
        } elseif ($this->summary->isEmpty()) {
            throw CouldNotPublish::becauseSummaryIsMissing();
        } elseif ($this->body->isEmpty()) {
            throw CouldNotPublish::becauseBodyIsMissing();
        }

        $this->forceFill([
            'published_at' => $this->freshTimestampString(),
            'state' => PostState::Published,
        ])->save();

        self::$dispatcher->dispatch(PostWasPublished::make($this));
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

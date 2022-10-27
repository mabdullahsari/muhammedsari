<?php declare(strict_types=1);

namespace Domain\Blogging;

use Carbon\CarbonImmutable;
use Domain\Blogging\Exceptions\CouldNotPublish;
use Domain\Blogging\ValueObjects\Body;
use Domain\Blogging\ValueObjects\PostState;
use Domain\Blogging\ValueObjects\Slug;
use Domain\Blogging\ValueObjects\Summary;
use Domain\Blogging\ValueObjects\Title;
use Domain\Common\Model\HasEvents;
use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Contracts\Clock\Clock;
use stdClass;

final class Post
{
    use HasEvents;

    private int $id;

    private Body $body;

    private ?CarbonImmutable $publishedAt;

    private Slug $slug;

    private PostState $state = PostState::Draft;

    private Summary $summary;

    private Title $title;

    private function __construct() {}

    public static function create(int $id, Body $body, Summary $summary, Title $title, Slug $slug): self
    {
        $post = new Post();

        $post->id = $id;
        $post->body = $body;
        $post->summary = $summary;
        $post->slug = $slug;
        $post->title = $title;

        return $post;
    }

    public static function fromDatabase(stdClass $record): self
    {
        $post = new Post();

        $post->id = (int) $record->id;
        $post->body = Body::fromString($record->body);
        $post->slug = Slug::fromString($record->slug);
        $post->state = PostState::from($record->state);
        $post->summary = Summary::fromString($record->summary);
        $post->title = Title::fromString($record->title);
        $post->publishedAt = transform($record->published_at, CarbonImmutable::parse(...)); // @phpstan-ignore-line

        return $post;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function publish(Clock $clock): void
    {
        if ($this->state->isPublished()) {
            throw CouldNotPublish::becauseAlreadyPublished();
        } elseif ($this->summary->isEmpty()) {
            throw CouldNotPublish::becauseSummaryIsMissing();
        } elseif ($this->body->isEmpty()) {
            throw CouldNotPublish::becauseBodyIsMissing();
        }

        $this->state = PostState::Published;
        $this->publishedAt = $clock->now();

        $this->raise(new PostWasPublished($this->id));
    }

    public function toDatabase(): array
    {
        return [
            'body' => (string) $this->body,
            'published_at' => $this->publishedAt?->toDateTimeString(),
            'slug' => (string) $this->slug,
            'state' => $this->state->value,
            'summary' => (string) $this->summary,
            'title' => (string) $this->title,
        ];
    }
}

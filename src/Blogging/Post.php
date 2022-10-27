<?php declare(strict_types=1);

namespace Domain\Blogging;

use Carbon\CarbonImmutable;
use Domain\Common\Entity;
use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Contracts\Clock\Clock;
use stdClass;

final class Post extends Entity
{
    private int $authorId;

    private int $id;

    private Body $body;

    private ?CarbonImmutable $publishedAt = null;

    private Slug $slug;

    private PostState $state = PostState::Draft;

    private Summary $summary;

    private Title $title;

    private function __construct() {}

    public static function create(int $id, int $authorId, Body $body, Summary $summary, Title $title, Slug $slug): self
    {
        $post = new Post();

        $post->authorId = $authorId;
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

        $post->authorId = (int) $record->author_id;
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
            'author_id' => $this->authorId,
            'body' => (string) $this->body,
            'published_at' => $this->publishedAt?->toDateTimeString(),
            'slug' => (string) $this->slug,
            'state' => $this->state->value,
            'summary' => (string) $this->summary,
            'title' => (string) $this->title,
        ];
    }
}

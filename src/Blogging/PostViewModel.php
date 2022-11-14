<?php declare(strict_types=1);

namespace Core\Blogging;

use Carbon\CarbonImmutable;
use Core\Blogging\Models\Post;
use JsonSerializable;

final readonly class PostViewModel implements JsonSerializable
{
    public function __construct(
        public string $body,
        public ?CarbonImmutable $publishedAt,
        public string $slug,
        public string $summary,
        public array $tags,
        public string $title,
    ) {}

    public static function fromEloquent(Post $post): self
    {
        return new self(
            $post->body,
            $post->published_at,
            $post->slug,
            $post->summary,
            $post->tags->map(TagViewModel::fromEloquent(...))->all(),
            $post->title,
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'body' => $this->body,
            'published_at' => $this->publishedAt?->toIso8601String(),
            'slug' => $this->slug,
            'summary' => $this->summary,
            'tags' => $this->tags,
            'title' => $this->title,
        ];
    }
}

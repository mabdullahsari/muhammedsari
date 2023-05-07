<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\Post;
use Blogging\Contract\PostSummary;
use Blogging\Contract\Tag;
use Blogging\Post as PostModel;
use Blogging\Tag as TagModel;
use Closure;
use Illuminate\Support\Collection;

final readonly class PostQueryBusUsingEloquent implements PostQueryBus
{
    public function __construct(private PostQueryBuilder $query) {}

    public function findBySlug(string $slug): Post
    {
        $post = $this->query
            ->newQuery()
            ->hasSlug($slug)
            ->with('tags')
            ->first(['body', 'id', 'published_at', 'slug', 'summary', 'title']);

        if (! $post instanceof PostModel) {
            throw CouldNotFindPost::withSlug($slug);
        }

        return new Post(
            $post->body,
            $post->published_at,
            $post->slug,
            $post->summary,
            $post->tags->map(static fn (TagModel $t) => new Tag($t->slug, $t->name))->all(),
            $post->title,
        );
    }

    public function get(): Collection
    {
        return $this->getSummaries();
    }

    public function getTitleBySlug(string $slug): string
    {
        $title = $this->query->newQuery()->hasSlug($slug)->value('title');

        if (! is_string($title)) {
            throw CouldNotFindPost::withSlug($slug);
        }

        return $title;
    }

    public function getByTag(Tag $tag): Collection
    {
        return $this->getSummaries(static fn (PostQueryBuilder $builder) => $builder->hasTag($tag->slug));
    }

    private function getSummaries(?Closure $modifier = null): Collection
    {
        return $this
            ->query
            ->newQuery()
            ->when($modifier, static fn (PostQueryBuilder $builder) => $builder->tap($modifier)) // @phpstan-ignore-line
            ->with('tags')
            ->isPublished()
            ->mostRecentFirst()
            ->get(['id', 'published_at', 'slug', 'summary', 'title'])
            ->map(static function (PostModel $p) {
                return new PostSummary(
                    $p->published_at,
                    $p->slug,
                    $p->summary,
                    $p->tags->map(static fn (TagModel $t) => new Tag($t->slug, $t->name))->all(),
                    $p->title,
                );
            });
    }
}

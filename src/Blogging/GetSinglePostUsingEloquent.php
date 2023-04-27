<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetSinglePost;
use Blogging\Contract\Post as PostViewModel;
use Blogging\Contract\Tag as TagViewModel;
use Blogging\Models\Post;
use Blogging\Models\Tag;

final readonly class GetSinglePostUsingEloquent implements GetSinglePost
{
    private const COLUMNS = ['body', 'id', 'published_at', 'slug', 'summary', 'title'];

    public function __construct(private Post $model) {}

    /** @throws CouldNotFindPost */
    public function get(string $slug): PostViewModel
    {
        $post = $this->model
            ->newQuery()
            ->where('slug', $slug)
            ->with('tags')
            ->first(self::COLUMNS);

        if (! $post instanceof Post) {
            throw CouldNotFindPost::withSlug($slug);
        }

        return new PostViewModel(
            $post->body,
            $post->published_at,
            $post->slug,
            $post->summary,
            $post->tags->map($this->asTag(...))->all(),
            $post->title,
        );
    }

    private function asTag(Tag $tag): TagViewModel
    {
        return new TagViewModel($tag->slug, $tag->name);
    }
}

<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetSinglePost;
use Blogging\Contract\Post as PostViewModel;
use Blogging\Contract\Tag as TagViewModel;

final readonly class GetSinglePostUsingEloquent implements GetSinglePost
{
    public function __construct(private Post $model) {}

    /** @throws CouldNotFindPost */
    public function get(string $slug): PostViewModel
    {
        $post = $this->model->newQuery()
            ->where('slug', $slug)
            ->with('tags')
            ->first(['body', 'id', 'published_at', 'slug', 'summary', 'title']);

        if (! $post instanceof Post) {
            throw CouldNotFindPost::withSlug($slug);
        }

        return new PostViewModel(
            $post->body,
            $post->published_at,
            $post->slug,
            $post->summary,
            $post->tags->map(static fn (Tag $t) => new TagViewModel($t->slug, $t->name))->all(),
            $post->title,
        );
    }
}

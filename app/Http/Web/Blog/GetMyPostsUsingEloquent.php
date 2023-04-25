<?php declare(strict_types=1);

namespace App\Http\Web\Blog;

use Blogging\Models\MustBePublished;
use Blogging\Models\Post;
use Blogging\Models\SortByPublicationDate;
use Blogging\PostSummaryViewModel;
use Illuminate\Support\Collection;

final readonly class GetMyPostsUsingEloquent implements GetMyPosts
{
    private const COLUMNS = ['published_at', 'slug', 'summary', 'title'];

    public function __construct(private Post $model) {}

    public function get(): Collection
    {
        return $this->model->newQuery()
            ->tap(new SortByPublicationDate())
            ->tap(new MustBePublished())
            ->get(self::COLUMNS)
            ->map(PostSummaryViewModel::fromEloquent(...))
            ->toBase();
    }
}

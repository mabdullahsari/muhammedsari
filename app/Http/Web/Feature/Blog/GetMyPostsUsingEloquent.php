<?php declare(strict_types=1);

namespace App\Http\Web\Feature\Blog;

use Core\Blogging\Models\Post;
use Core\Blogging\Models\MustBePublished;
use Core\Blogging\Models\SortByPublicationDate;
use Core\Blogging\PostSummaryViewModel;
use Illuminate\Support\Collection;

final readonly class GetMyPostsUsingEloquent implements GetMyPosts
{
    private const COLUMNS = ['published_at', 'slug', 'summary', 'title'];

    public function __construct(
        private Post $model,
    ) {}

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

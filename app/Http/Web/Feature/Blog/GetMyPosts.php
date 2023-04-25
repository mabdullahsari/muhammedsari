<?php declare(strict_types=1);

namespace App\Http\Web\Feature\Blog;

use Blogging\PostSummaryViewModel;
use Illuminate\Support\Collection;

interface GetMyPosts
{
    /** @return Collection<int, PostSummaryViewModel> */
    public function get(): Collection;
}

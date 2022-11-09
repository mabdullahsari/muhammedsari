<?php declare(strict_types=1);

namespace App\Web\Blog;

use Core\Blogging\PostViewModel;

interface GetSinglePost
{
    public function get(string $slug): ?PostViewModel;
}

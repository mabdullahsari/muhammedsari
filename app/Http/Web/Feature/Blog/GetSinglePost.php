<?php declare(strict_types=1);

namespace App\Http\Web\Feature\Blog;

use Core\Blogging\PostViewModel;

interface GetSinglePost
{
    /** @throws CouldNotGetPost */
    public function get(string $slug): PostViewModel;
}

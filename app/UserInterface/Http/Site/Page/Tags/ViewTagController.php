<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Tags;

use Blogging\Contract\GetMyPostsByTag;
use Blogging\Contract\GetSingleTag;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final readonly class ViewTagController
{
    public function __construct(
        private GetMyPostsByTag $posts,
        private GetSingleTag $tags,
        private Factory $view,
    ) {}

    public function __invoke(string $slug): View
    {
        return $this->view->make('view-tag', [
            'tag' => ($tag = $this->tags->get($slug)),
            'posts' => $this->posts->get($tag),
        ]);
    }
}

<?php declare(strict_types=1);

namespace App\Http\Site\Page\Tags;

use Blogging\Contract\GetMyPostsByTag;
use Blogging\Contract\GetSingleTag;
use Blogging\CouldNotFindTag;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class ViewTagController
{
    public function __construct(
        private GetMyPostsByTag $posts,
        private ResponseFactory $response,
        private GetSingleTag $tags,
    ) {}

    /** @throws CouldNotFindTag */
    public function __invoke(Request $request, string $slug): Response
    {
        $posts = $this->posts->getByTag($tag = $this->tags->findBySlug($slug));

        if ($request->expectsJson()) {
            return $this->response->json($posts);
        }

        return $this->response->view('view-tag', ['posts' => $posts, 'tag' => $tag]);
    }
}

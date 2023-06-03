<?php declare(strict_types=1);

namespace App\Http\Site\Page\Blog;

use Blogging\Contract\GetMyPosts;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class ViewBlogController
{
    public function __construct(
        private GetMyPosts $query,
        private ResponseFactory $response,
    ) {}

    public function __invoke(Request $request): Response
    {
        $posts = $this->query->get();

        if ($request->expectsJson()) {
            return $this->response->json($posts);
        }

        return $this->response->view('view-blog', ['posts' => $posts]);
    }
}

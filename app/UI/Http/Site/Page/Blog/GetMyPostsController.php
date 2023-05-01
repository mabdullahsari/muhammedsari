<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Blog;

use Blogging\Contract\GetMyPosts;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class GetMyPostsController
{
    public const ROUTE = 'blog';

    public function __construct(
        private GetMyPosts $query,
        private Request $request,
        private ResponseFactory $response,
    ) {}

    public function __invoke(): Response
    {
        $posts = $this->query->get();

        if ($this->request->expectsJson()) {
            return $this->response->json($posts);
        }

        return $this->response->view('Blog::GetMyPosts', ['posts' => $posts]);
    }
}

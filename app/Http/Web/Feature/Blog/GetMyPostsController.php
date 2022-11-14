<?php declare(strict_types=1);

namespace App\Http\Web\Feature\Blog;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Symfony\Component\HttpFoundation\Response;

final readonly class GetMyPostsController
{
    public function __construct(
        private GetMyPosts $query,
        private Request $request,
        private ResponseFactory $response,
    ) {}

    #[Get('blog')]
    public function __invoke(): Response
    {
        $posts = $this->query->get();

        if ($this->request->expectsJson()) {
            return $this->response->json($posts);
        }

        return $this->response->view('Blog::GetMyPosts', ['posts' => $posts]);
    }
}

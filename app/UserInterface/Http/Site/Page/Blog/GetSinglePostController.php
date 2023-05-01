<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Blog;

use Blogging\Contract\GetSinglePost;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class GetSinglePostController
{
    public function __construct(
        private GetSinglePost $query,
        private Request $request,
        private ResponseFactory $response,
    ) {}

    public function __invoke(string $slug): Response
    {
        $post = $this->query->get($slug);

        if ($this->request->expectsJson()) {
            return $this->response->json($post);
        }

        return $this->response->view('Blog::GetSinglePost', ['post' => $post]);
    }
}

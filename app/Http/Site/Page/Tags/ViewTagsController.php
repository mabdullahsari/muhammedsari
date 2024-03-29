<?php declare(strict_types=1);

namespace App\Http\Site\Page\Tags;

use Blogging\Contract\GetAllTags;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class ViewTagsController
{
    public const string ROUTE = 'tags';

    public function __construct(
        private ResponseFactory $response,
        private GetAllTags $tags,
    ) {}

    public function __invoke(Request $request): Response
    {
        $tags = $this->tags->get();

        if ($request->expectsJson()) {
            return $this->response->json($tags);
        }

        return $this->response->view('view-tags', ['tags' => $tags]);
    }
}

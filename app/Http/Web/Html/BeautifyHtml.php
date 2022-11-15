<?php declare(strict_types=1);

namespace App\Http\Web\Html;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class BeautifyHtml
{
    public function __construct(
        private HtmlBeautifier $html,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $content = $response->getContent();

        if ($content === false || ! $this->isHtml($content)) {
            return $response;
        }

        return $response->setContent(
            $this->html->beautify($content)
        );
    }

    private function isHtml(string $content): bool
    {
        return str_starts_with($content, '<!DOCTYPE html>');
    }
}

<?php declare(strict_types=1);

namespace App\UserInterface\Http;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

final readonly class StripTrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->getPathInfo();

        if ($path === DIRECTORY_SEPARATOR || ! str_ends_with($path, DIRECTORY_SEPARATOR)) {
            return $next($request);
        }

        $url = Str::of($request->getRequestUri())
            ->replaceLast(DIRECTORY_SEPARATOR, '')
            ->value();

        return new RedirectResponse($url, Response::HTTP_MOVED_PERMANENTLY);
    }
}

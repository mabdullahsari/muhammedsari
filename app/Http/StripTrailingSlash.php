<?php declare(strict_types=1);

namespace App\Http;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

final readonly class StripTrailingSlash
{
    private const FORWARD_SLASH = '/';

    public function handle(Request $request, Closure $next): mixed
    {
        $path = $request->getPathInfo();

        if ($path === self::FORWARD_SLASH || ! str_ends_with($path, self::FORWARD_SLASH)) {
            return $next($request);
        }

        $url = Str::of($request->getRequestUri())
            ->replaceLast(self::FORWARD_SLASH, '')
            ->value();

        return new RedirectResponse($url, Response::HTTP_MOVED_PERMANENTLY);
    }
}

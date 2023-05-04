<?php declare(strict_types=1);

namespace Blogging;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class CouldNotFindTag extends Exception implements HttpExceptionInterface
{
    public static function withSlug(string $slug): self
    {
        return new self("Could not find '{$slug}'.");
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_NOT_FOUND;
    }

    public function getHeaders(): array
    {
        return [];
    }
}

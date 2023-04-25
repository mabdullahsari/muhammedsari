<?php declare(strict_types=1);

namespace Blogging\Contract;

use Blogging\PostId;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class CouldNotFindPost extends Exception implements HttpExceptionInterface
{
    public static function withId(PostId $id): self
    {
        return new self("Couldn't find Post with id {$id->asInt()}");
    }

    public static function withSlug(string $slug): self
    {
        return new self("Couldn't find {$slug}.");
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

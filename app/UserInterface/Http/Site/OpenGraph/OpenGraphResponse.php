<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\OpenGraph;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Previewing\Contract\Preview;

final readonly class OpenGraphResponse implements Responsable
{
    private const ONE_WEEK = 604_800;

    public function __construct(private Preview $preview) {}

    public function toResponse($request): Response
    {
        $response = new Response($this->preview->image);
        $response->header('Content-Length', (string) $this->preview->sizeInBytes);
        $response->header('Content-Type', $this->preview->type);
        $response->setClientTtl(self::ONE_WEEK);

        return $response;
    }
}

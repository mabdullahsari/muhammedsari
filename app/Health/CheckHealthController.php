<?php declare(strict_types=1);

namespace App\Health;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

final readonly class CheckHealthController
{
    public const ROUTE = 'health';

    public function __construct(private ResponseFactory $response) {}

    public function __invoke(): JsonResponse
    {
        return $this->response->json(['message' => 'ok']);
    }
}

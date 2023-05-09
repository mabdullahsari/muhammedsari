<?php declare(strict_types=1);

namespace App\UserInterface\Http\Horizon;

use Illuminate\Http\Request;

final readonly class AuthorizeAccess
{
    public function __invoke(Request $request): bool
    {
        return (bool) $request->user();
    }
}

<?php declare(strict_types=1);

namespace App\Http\Web\Feature\Uses;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\RouteAttributes\Attributes\Get;

final readonly class UsesController
{
    public function __construct(
        private Factory $view,
    ) {}

    #[Get('uses')]
    public function index(): View
    {
        return $this->view->make('Uses::Index');
    }
}

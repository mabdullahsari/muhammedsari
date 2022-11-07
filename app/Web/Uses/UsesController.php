<?php declare(strict_types=1);

namespace App\Web\Uses;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final readonly class UsesController
{
    public function __construct(
        private Factory $view,
    ) {}

    public function index(): View
    {
        return $this->view->make('Uses.Index');
    }
}

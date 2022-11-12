<?php declare(strict_types=1);

namespace App\Web\OSS;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\RouteAttributes\Attributes\Get;

final readonly class OSSController
{
    public function __construct(
        private Factory $view,
    ) {}

    #[Get('oss', 'oss')]
    public function index(): View
    {
        return $this->view->make('OSS::Index');
    }
}

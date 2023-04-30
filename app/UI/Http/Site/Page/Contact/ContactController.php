<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Contact;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\RouteAttributes\Attributes\Get;

final readonly class ContactController
{
    public const ROUTE = 'contact';

    public function __construct(private Factory $view) {}

    #[Get(self::ROUTE, self::ROUTE)]
    public function index(): View
    {
        return $this->view->make('Contact::Index');
    }
}

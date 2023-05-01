<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Contact;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final readonly class ContactController
{
    public const INDEX = 'contact';

    public function __construct(private Factory $view) {}

    public function index(): View
    {
        return $this->view->make('Contact::Index');
    }
}

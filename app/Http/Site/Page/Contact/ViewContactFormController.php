<?php declare(strict_types=1);

namespace App\Http\Site\Page\Contact;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final readonly class ViewContactFormController
{
    public const ROUTE = 'contact';
    public const SUCCESS = 'success';

    public function __construct(private Factory $view) {}

    public function __invoke(Request $request): View
    {
        return $this->view->make('contact', [
            'didSubmit' => $request->boolean(self::SUCCESS),
        ]);
    }
}
